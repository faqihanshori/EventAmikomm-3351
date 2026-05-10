@extends('layouts.admin')

@section('title', 'Kelola Event')
@section('page_title', 'Kelola Event')
@section('page_subtitle', 'Buat dan atur acara seru di sini.')

@section('content')

<div class="mb-6 flex justify-end">
    <a href="{{ route('admin.events.create') }}"
       class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white
              rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition">
        + Tambah Event Baru
    </a>
</div>

<div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
                <tr>
                    <th class="px-6 py-4 w-12">No</th>
                    <th class="px-6 py-4 w-24">Poster</th>
                    <th class="px-6 py-4">Event</th>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4">Harga / Stok</th>
                    <th class="px-6 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y border-t">

                @forelse($events as $index => $event)
                <tr class="hover:bg-slate-50/50 transition">

                    {{-- Nomor urut tetap benar saat pindah halaman --}}
                    <td class="px-6 py-5 font-bold text-slate-400">
                        {{ $events->firstItem() + $index }}
                    </td>

                    {{-- Thumbnail poster —
                         Storage::url() mengubah path DB "posters/abc.jpg"
                         menjadi URL lengkap "http://localhost/storage/posters/abc.jpg" --}}
                    <td class="px-6 py-5">
                        @if($event->poster_path)
                            <img src="{{ Storage::url($event->poster_path) }}"
                                 alt="Poster {{ $event->title }}"
                                 class="w-16 h-16 object-cover rounded-2xl border border-slate-100 shadow-sm">
                        @else
                            {{-- Placeholder ikon jika belum ada poster --}}
                            <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center
                                        justify-center text-slate-300">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2
                                             0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0
                                             00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                    </td>

                    {{-- Judul, lokasi, tanggal --}}
                    <td class="px-6 py-5">
                        <p class="font-black text-slate-800">{{ $event->title }}</p>
                        <p class="text-xs text-slate-400 mt-1">📍 {{ $event->location }}</p>
                        <p class="text-xs text-slate-400">🗓️ {{ $event->date->format('d M Y, H:i') }} WIB</p>
                    </td>

                    {{-- Badge kategori --}}
                    <td class="px-6 py-5">
                        <span class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-lg text-xs font-bold">
                            {{ $event->category->name ?? '-' }}
                        </span>
                    </td>

                    {{-- Harga dan stok --}}
                    <td class="px-6 py-5">
                        @if($event->price == 0)
                            <p class="font-bold text-green-600">GRATIS</p>
                        @else
                            <p class="font-bold text-indigo-600">Rp {{ number_format($event->price, 0, ',', '.') }}</p>
                        @endif
                        <p class="text-xs text-slate-400 mt-1">Stok: {{ $event->stock }} tiket</p>
                    </td>

                    {{-- Tombol aksi --}}
                    <td class="px-6 py-5">
                        <div class="flex gap-2">

                            {{-- EDIT --}}
                            <a href="{{ route('admin.events.edit', $event->id) }}"
                               class="p-2.5 bg-indigo-50 text-indigo-600 rounded-xl
                                      hover:bg-indigo-600 hover:text-white transition" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0
                                             002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828
                                             15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>

                            {{-- HAPUS: wajib pakai form POST + @method('DELETE')
                                 karena browser HTML tidak bisa kirim request DELETE langsung --}}
                            <form action="{{ route('admin.events.destroy', $event->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin hapus event ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="p-2.5 bg-rose-50 text-rose-600 rounded-xl
                                               hover:bg-rose-600 hover:text-white transition" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0
                                                 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0
                                                 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="6" class="px-8 py-20 text-center">
                        <p class="text-slate-400 font-bold text-lg">Belum ada event.</p>
                        <a href="{{ route('admin.events.create') }}"
                           class="text-indigo-600 font-bold hover:underline text-sm mt-2 inline-block">
                            + Tambah event pertama
                        </a>
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>

    {{-- Paginasi bawaan Laravel --}}
    <div class="px-8 py-5 bg-slate-50/50 border-t">
        {{ $events->links() }}
    </div>
</div>

@endsection
