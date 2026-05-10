<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    // ── READ ──────────────────────────────────────────────
    // GET /admin/events
    public function index()
    {
        $events = Event::with('category')->latest()->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    // ── CREATE ────────────────────────────────────────────
    // GET /admin/events/create
    public function create()
    {
        $categories = Category::all();
        return view('admin.events.create', compact('categories'));
    }

    // ── STORE ─────────────────────────────────────────────
    // POST /admin/events
    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'date'        => 'required|date',
            'location'    => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|numeric|min:1',
            // nullable  = boleh tidak diisi (event tanpa poster)
            // image     = wajib berupa file gambar
            // max:2048  = maksimal 2 MB
            'poster'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Proses upload poster jika ada file yang dikirim
        if ($request->hasFile('poster')) {
            // store() otomatis beri nama unik & simpan ke storage/app/public/posters/
            // Path yang tersimpan di DB contoh: "posters/AbCxYz123.jpg"
            $data['poster_path'] = $request->file('poster')->store('posters', 'public');
        }

        // Hapus key 'poster' dari $data karena kolom DB-nya adalah 'poster_path'
        unset($data['poster']);

        Event::create($data);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event berhasil ditambahkan!');
    }

    // ── EDIT ──────────────────────────────────────────────
    // GET /admin/events/{event}/edit
    public function edit(Event $event)
    {
        $categories = Category::all();
        return view('admin.events.edit', compact('event', 'categories'));
    }

    // ── UPDATE ────────────────────────────────────────────
    // PUT /admin/events/{event}
    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'date'        => 'required|date',
            'location'    => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|numeric|min:1',
            // nullable = boleh kosong (artinya poster tidak diganti)
            'poster'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('poster')) {
            // Hapus poster lama dari storage sebelum simpan yang baru
            // Mencegah penumpukan file tidak terpakai di server
            if ($event->poster_path) {
                Storage::disk('public')->delete($event->poster_path);
            }
            $data['poster_path'] = $request->file('poster')->store('posters', 'public');
        }

        unset($data['poster']);

        $event->update($data);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Data event berhasil diperbarui!');
    }

    // ── DESTROY ───────────────────────────────────────────
    // DELETE /admin/events/{event}
    public function destroy(Event $event)
    {
        // Hapus file poster dari storage jika ada, baru hapus record dari DB
        if ($event->poster_path) {
            Storage::disk('public')->delete($event->poster_path);
        }

        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event berhasil dihapus.');
    }
}
