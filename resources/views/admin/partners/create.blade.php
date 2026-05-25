@extends('layouts.admin')

@section('page_title', 'Tambah Partner')
@section('page_subtitle', 'Isi form di bawah untuk menambah partner baru.')

@section('content')
<div class="max-w-2xl">

    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-sm text-slate-400 mb-6">
        <a href="{{ route('admin.partners.index') }}" class="hover:text-indigo-600 transition font-medium">Partner</a>
        <span>/</span>
        <span class="text-slate-700 font-semibold">Tambah Baru</span>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8">
        <form action="{{ route('admin.partners.store') }}" method="POST">
            @csrf

            {{-- Field Nama Partner --}}
            <div class="mb-5">
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5">
                    Nama Partner <span class="text-red-500">*</span>
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                    placeholder="Contoh: Google, Tokopedia, Telkom Indonesia..."
                    class="w-full border @error('name') border-red-400 bg-red-50 @else border-slate-200 @enderror
                           rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-300 transition">
                @error('name')
                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Field Logo URL --}}
            <div class="mb-6">
                <label for="logo_url" class="block text-sm font-semibold text-slate-700 mb-1.5">
                    URL Logo <span class="text-slate-400 font-normal text-xs">(opsional)</span>
                </label>
                <input type="url" id="logo_url" name="logo_url" value="{{ old('logo_url') }}"
                    placeholder="https://example.com/logo.png"
                    class="w-full border @error('logo_url') border-red-400 bg-red-50 @else border-slate-200 @enderror
                           rounded-xl px-4 py-3 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-indigo-300 transition">
                @error('logo_url')
                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                @enderror
                <p class="mt-1.5 text-xs text-slate-400">Masukkan link URL gambar logo partner (format PNG/JPG/SVG/WebP).</p>
            </div>

            {{-- Preview Logo (dinamis via JS) --}}
            <div id="logo-preview-wrapper" class="mb-8 hidden">
                <p class="text-sm font-semibold text-slate-700 mb-2">Preview Logo:</p>
                <div class="w-24 h-24 border-2 border-dashed border-slate-200 rounded-xl flex items-center justify-center bg-slate-50 p-2">
                    <img id="logo-preview" src="" alt="Preview" class="max-w-full max-h-full object-contain">
                </div>
            </div>

            {{-- Tombol --}}
            <div class="flex gap-3">
                <button type="submit"
                    class="px-6 py-3 bg-indigo-600 text-white rounded-xl font-semibold hover:bg-indigo-700 transition shadow-sm">
                    Simpan Partner
                </button>
                <a href="{{ route('admin.partners.index') }}"
                    class="px-6 py-3 bg-slate-100 text-slate-600 rounded-xl font-semibold hover:bg-slate-200 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@section('scripts')
<script>
    // Preview logo otomatis saat URL diketik
    const logoInput = document.getElementById('logo_url');
    const previewWrapper = document.getElementById('logo-preview-wrapper');
    const previewImg = document.getElementById('logo-preview');

    logoInput.addEventListener('input', function () {
        const url = this.value.trim();
        if (url) {
            previewImg.src = url;
            previewWrapper.classList.remove('hidden');
        } else {
            previewWrapper.classList.add('hidden');
        }
    });
</script>
@endsection

@endsection
