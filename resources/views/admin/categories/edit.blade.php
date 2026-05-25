@extends('layouts.admin')

@section('page_title', 'Edit Kategori')
@section('page_subtitle', 'Ubah nama atau slug kategori yang sudah ada.')

@section('content')
<div class="p-6 max-w-2xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.categories.index') }}"
            class="p-2 rounded-xl hover:bg-gray-100 transition text-gray-500">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Kategori</h1>
            <p class="text-sm text-gray-500 mt-0.5">Mengubah data kategori: <strong>{{ $category->name }}</strong></p>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Field Nama --}}
            <div class="mb-5">
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <input type="text" id="name" name="name"
                    value="{{ old('name', $category->name) }}"
                    placeholder="Contoh: Seminar IT, Workshop, Entertainment..."
                    class="w-full border @error('name') border-red-400 bg-red-50 @else border-gray-200 @enderror
                           rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300 transition">
                @error('name')
                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Field Slug --}}
            <div class="mb-8">
                <label for="slug" class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Slug <span class="text-gray-400 font-normal text-xs">(kosongkan untuk generate otomatis dari nama)</span>
                </label>
                <input type="text" id="slug" name="slug"
                    value="{{ old('slug', $category->slug) }}"
                    placeholder="Contoh: seminar-it"
                    class="w-full border @error('slug') border-red-400 bg-red-50 @else border-gray-200 @enderror
                           rounded-xl px-4 py-3 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-indigo-300 transition">
                @error('slug')
                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Info ID & Tanggal --}}
            <div class="mb-6 p-4 bg-gray-50 rounded-xl text-xs text-gray-500 grid grid-cols-3 gap-4">
                <div>
                    <span class="font-semibold uppercase tracking-wide block mb-1">ID</span>
                    <span class="font-mono text-gray-700">{{ $category->id }}</span>
                </div>
                <div>
                    <span class="font-semibold uppercase tracking-wide block mb-1">Dibuat</span>
                    <span>{{ $category->created_at->format('d M Y, H:i') }}</span>
                </div>
                <div>
                    <span class="font-semibold uppercase tracking-wide block mb-1">Diperbarui</span>
                    <span>{{ $category->updated_at->format('d M Y, H:i') }}</span>
                </div>
            </div>

            {{-- Tombol --}}
            <div class="flex gap-3">
                <button type="submit"
                    class="px-6 py-3 bg-indigo-600 text-white rounded-xl font-semibold hover:bg-indigo-700 transition shadow-sm">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.categories.index') }}"
                    class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-semibold hover:bg-gray-200 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
