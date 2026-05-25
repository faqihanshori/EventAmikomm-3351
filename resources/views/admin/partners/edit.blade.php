@extends('layouts.admin')

@section('page_title', 'Edit Partner')
@section('page_subtitle', 'Ubah data partner yang sudah terdaftar.')

@section('content')
<div class="max-w-2xl">

    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-sm text-slate-400 mb-6">
        <a href="{{ route('admin.partners.index') }}" class="hover:text-indigo-600 transition font-medium">Partner</a>
        <span>/</span>
        <span class="text-slate-700 font-semibold">Edit: {{ $partner->name }}</span>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-8">
        <form action="{{ route('admin.partners.update', $partner) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Field Nama Partner --}}
            <div class="mb-5">
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5">
                    Nama Partner <span class="text-red-500">*</span>
                </label>
                <input type="text" id="name" name="name"
                    value="{{ old('name', $partner->name) }}"
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
                <input type="url" id="logo_url" name="logo_url"
                    value="{{ old('logo_url', $partner->logo_url) }}"
                    placeholder="https://example.com/logo.png"
                    class="w-full border @error('logo_url') border-red-400 bg-red-50 @else border-slate-200 @enderror
                           rounded-xl px-4 py-3 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-indigo-300 transition">
                @error('logo_url')
                    <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Preview Logo --}}
            <div class="mb-6">
                <p class="text-sm font-semibold text-slate-700 mb-2">Preview Logo:</p>
                <div class="w-24 h-24 border-2 border-dashed border-slate-200 rounded-xl flex items-center justify-center bg-slate-50 p-2">
                    <img id="logo-preview"
                        src="{{ $partner->logo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($partner->name).'&background=e0e7ff&color=4f46e5' }}"
                        alt="{{ $partner->name }}"
                        class="max-w-full max-h-full object-contain"
                        onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($partner->name) }}&background=e0e7ff&color=4f46e5'">
                </div>
            </div>

            {{-- Info Meta --}}
            <div class="mb-6 p-4 bg-slate-50 rounded-xl text-xs text-slate-500 grid grid-cols-3 gap-4">
                <div>
                    <span class="font-semibold uppercase tracking-wide block mb-1">ID</span>
                    <span class="font-mono text-slate-700">{{ $partner->id }}</span>
                </div>
                <div>
                    <span class="font-semibold uppercase tracking-wide block mb-1">Dibuat</span>
                    <span>{{ $partner->created_at->format('d M Y, H:i') }}</span>
                </div>
                <div>
                    <span class="font-semibold uppercase tracking-wide block mb-1">Diperbarui</span>
                    <span>{{ $partner->updated_at->format('d M Y, H:i') }}</span>
                </div>
            </div>

            {{-- Tombol --}}
            <div class="flex gap-3">
                <button type="submit"
                    class="px-6 py-3 bg-indigo-600 text-white rounded-xl font-semibold hover:bg-indigo-700 transition shadow-sm">
                    Simpan Perubahan
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
    // Preview logo langsung saat URL diubah
    const logoInput = document.getElementById('logo_url');
    const previewImg = document.getElementById('logo-preview');

    logoInput.addEventListener('input', function () {
        const url = this.value.trim();
        if (url) {
            previewImg.src = url;
        }
    });
</script>
@endsection

@endsection
