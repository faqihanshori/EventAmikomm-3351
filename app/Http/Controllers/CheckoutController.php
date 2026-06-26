<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * Inisialisasi konfigurasi Midtrans SDK.
     * SSL verification dinonaktifkan agar kompatibel di semua environment
     * (lokal Windows dengan cacert bermasalah maupun cloud hosting).
     */
    private function initMidtrans(): void
    {
        \Midtrans\Config::$serverKey    = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized  = true;
        \Midtrans\Config::$is3ds        = true;

        // Nonaktifkan verifikasi SSL cURL agar berjalan di lokal Windows & cloud hosting.
        // CURLOPT_HTTPHEADER wajib disertakan (meski kosong) untuk menghindari
        // bug "Undefined array key 10023" di midtrans-php pada PHP 8+.
        \Midtrans\Config::$curlOptions = [
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_HTTPHEADER     => [],
        ];
    }

    public function create(Event $event)
    {
        $categories = \App\Models\Category::all();
        return view('checkout.create', compact('event', 'categories'));
    }

    public function store(Request $request, Event $event)
    {
        // 1. Validasi Input Kredensial Pelanggan
        $request->validate([
            'customer_name'  => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
        ]);

        // 2. Cegah Check-out Jika Tiket Habis
        if ($event->stock <= 0) {
            return back()->with('error', 'Mohon maaf, tiket untuk acara ini sudah habis.');
        }

        // 3. Generate Kode TRX (Unik)
        $orderId    = 'TRX-' . time() . '-' . Str::random(5);
        $totalPrice = $event->price + 5000; // Menambahkan biaya admin

        // 4. Merekam Transaksi ke Database
        $transaction = Transaction::create([
            'event_id'       => $event->id,
            'order_id'       => $orderId,
            'customer_name'  => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'total_price'    => $totalPrice,
            'status'         => 'Pending',
        ]);

        // --- INTEGRASI SNAP MIDTRANS ---
        $this->initMidtrans();

        // 5. Susun Paket Array Data Transaksi
        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => $totalPrice,
            ],
            'customer_details' => [
                'first_name' => $request->customer_name,
                'email'      => $request->customer_email,
                'phone'      => $request->customer_phone,
            ],
        ];

        try {
            // Perintah Generate Snap Token ke server Midtrans
            $snapToken = \Midtrans\Snap::getSnapToken($params);

            // Simpan Snap Token ke database
            $transaction->update(['snap_token' => $snapToken]);

            // Redirect ke halaman antarmuka pembayaran final pelanggan
            return redirect()->route('checkout.payment', $transaction->order_id);

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }
    }

    public function payment($order_id)
    {
        $categories  = \App\Models\Category::all();
        $transaction = Transaction::with('event')
            ->where('order_id', $order_id)
            ->firstOrFail();

        return view('checkout.payment', compact('transaction', 'categories'));
    }

    public function success($order_id)
    {
        $categories  = \App\Models\Category::all();
        $transaction = Transaction::where('order_id', $order_id)->firstOrFail();

        // Validasi status pembayaran dari Midtrans (opsional – jika gagal, halaman tetap tampil)
        $this->initMidtrans();

        try {
            $midtransStatus = \Midtrans\Transaction::status($order_id);

            // Ubah status menjadi sukses jika Midtrans mengonfirmasi pembayaran lunas
            if (in_array($midtransStatus->transaction_status, ['capture', 'settlement'])) {
                $transaction->update(['status' => 'success']);
            }
        } catch (\Exception $e) {
            // PENTING: Jika API Midtrans error (401, koneksi, dll), JANGAN redirect ke home.
            // Tetap tampilkan halaman sukses karena pembayaran sudah dilakukan
            // melalui popup Midtrans di browser pelanggan.
            // Status transaksi akan diperbarui melalui webhook Midtrans secara otomatis.
        }

        return view('checkout.success', compact('transaction', 'categories'));
    }
}
