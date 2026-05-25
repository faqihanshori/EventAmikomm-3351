@extends('layouts.admin')

@section('page_title', 'Manajemen Partner')
@section('page_subtitle', 'Kelola daftar partner/sponsor yang mendukung platform.')

@section('content')
<div>
    {{-- Header Aksi --}}
    <div class="flex items-center justify-between mb-6">
        <div></div>
        <a href="{{ route('admin.partners.create') }}"
            class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 text-white rounded-xl font-semibold hover:bg-indigo-700 transition shadow">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Partner
        </a>
    </div>

    {{-- Soal 3: Form Search --}}
    <div class="mb-4">
        <form method="GET" action="{{ route('admin.partners.index') }}" class="flex gap-2">
            <input type="text" name="search" value="{{ $search ?? '' }}"
                placeholder="Cari nama partner..."
                class="flex-1 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300">
            <button type="submit"
                class="px-5 py-2.5 bg-indigo-600 text-white rounded-xl text-sm font-semibold hover:bg-indigo-700 transition">
                Cari
            </button>
            @if($search)
            <a href="{{ route('admin.partners.index') }}"
                class="px-5 py-2.5 bg-gray-100 text-gray-600 rounded-xl text-sm font-semibold hover:bg-gray-200 transition">
                Reset
            </a>
            @endif
        </form>
    </div>

    {{-- Tabel Partner --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 border-b border-slate-100">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Logo</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Partner</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Logo URL</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Dibuat</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Diperbarui</th>
                    <th class="px-6 py-4 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($partners as $partner)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-6 py-4 text-slate-400 font-mono text-xs">{{ $partner->id }}</td>
                    <td class="px-6 py-4">
                        @if($partner->logo_url)
                            <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}"
                                class="w-12 h-12 object-contain rounded-lg border border-slate-100 bg-white p-1"
                                onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($partner->name) }}&background=e0e7ff&color=4f46e5'">
                        @else
                            <div class="w-12 h-12 bg-indigo-50 rounded-lg flex items-center justify-center text-indigo-600 font-bold text-sm">
                                {{ strtoupper(substr($partner->name, 0, 2)) }}
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 font-semibold text-slate-800">{{ $partner->name }}</td>
                    <td class="px-6 py-4 text-slate-400 text-xs font-mono max-w-[200px] truncate">
                        {{ $partner->logo_url ?? '-' }}
                    </td>
                    <td class="px-6 py-4 text-slate-500">{{ $partner->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-slate-500">{{ $partner->updated_at->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-2">
                            {{-- Tombol Edit --}}
                            <a href="{{ route('admin.partners.edit', $partner) }}"
                                class="px-3 py-1.5 bg-amber-50 text-amber-600 rounded-lg text-xs font-semibold hover:bg-amber-100 transition">
                                Edit
                            </a>
                            {{-- Tombol Hapus --}}
                            <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus partner \'{{ $partner->name }}\'?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-3 py-1.5 bg-red-50 text-red-600 rounded-lg text-xs font-semibold hover:bg-red-100 transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-16 text-center text-slate-400">
                        <div class="flex flex-col items-center gap-2">
                            <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-sm">Belum ada data partner.</span>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        @if($partners->hasPages())
        <div class="px-6 py-4 border-t border-slate-100">
            {{ $partners->appends(['search' => $search])->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
