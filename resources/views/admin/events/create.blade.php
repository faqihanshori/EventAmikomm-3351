@extends('layouts.admin')

@section('title', 'Tambah Event Baru')
@section('page_title', 'Tambah Event Baru')
@section('page_subtitle', 'Lengkapi detail acara yang akan diselenggarakan.')

@section('content')
<div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm max-w-3xl">

    {{-- enctype="multipart/form-data" WAJIB ada jika form punya input file --}}
    <form action="{{ route('admin.events.store') }}" method="POST"
          enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- JUDUL --}}
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">
                Judul Event <span class="text-red-500">*</span>
            </label>
            {{-- old('title') = isi ulang otomatis saat validasi gagal --}}
            <input type="text" name="title" value="{{ old('title') }}"
                   placeholder="contoh: Jazz Night 2026"
                   class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl
                          focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600
                          outline-none transition font-medium" required>
            @error('title')
                <p class="text-red-500 text-sm mt-1.5 font-medium">⚠ {{ $message }}</p>
            @enderror
        </div>

        {{-- KATEGORI --}}
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">
                Kategori <span class="text-red-500">*</span>
            </label>
            <select name="category_id"
                    class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl
                           focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600
                           outline-none transition font-medium" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="text-red-500 text-sm mt-1.5 font-medium">⚠ {{ $message }}</p>
            @enderror
        </div>

        {{-- DESKRIPSI --}}
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">
                Deskripsi <span class="text-red-500">*</span>
            </label>
            <textarea name="description" rows="4"
                      placeholder="Tuliskan deskripsi singkat acara..."
                      class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl
                             focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600
                             outline-none transition font-medium resize-none">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1.5 font-medium">⚠ {{ $message }}</p>
            @enderror
        </div>

        {{-- TANGGAL & LOKASI --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">
                    Tanggal & Waktu <span class="text-red-500">*</span>
                </label>
                <input type="datetime-local" name="date" value="{{ old('date') }}"
                       class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl
                              focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600
                              outline-none transition font-medium" required>
                @error('date')
                    <p class="text-red-500 text-sm mt-1.5 font-medium">⚠ {{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">
                    Lokasi <span class="text-red-500">*</span>
                </label>
                <input type="text" name="location" value="{{ old('location') }}"
                       placeholder="contoh: Auditorium AMIKOM"
                       class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl
                              focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600
                              outline-none transition font-medium" required>
                @error('location')
                    <p class="text-red-500 text-sm mt-1.5 font-medium">⚠ {{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- HARGA & STOK --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">
                    Harga (Rp)
                    <span class="text-slate-400 font-normal normal-case text-xs">— 0 jika gratis</span>
                </label>
                <input type="number" name="price" value="{{ old('price', 0) }}"
                       class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl
                              focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600
                              outline-none transition font-medium" required min="0">
                @error('price')
                    <p class="text-red-500 text-sm mt-1.5 font-medium">⚠ {{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">
                    Kapasitas Tiket <span class="text-red-500">*</span>
                </label>
                <input type="number" name="stock" value="{{ old('stock', 100) }}"
                       class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl
                              focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600
                              outline-none transition font-medium" required min="1">
                @error('stock')
                    <p class="text-red-500 text-sm mt-1.5 font-medium">⚠ {{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- UPLOAD POSTER --}}
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">
                Poster Event
                <span class="text-slate-400 font-normal normal-case text-xs">— JPG/PNG/WEBP, maks. 2 MB</span>
            </label>

            {{-- Input file disembunyikan, diganti label yang lebih bagus --}}
            <input type="file" name="poster" id="poster_create" accept="image/*"
                   class="hidden" onchange="previewImage(this, 'preview_create', 'placeholder_create')">

            <label for="poster_create"
                   class="flex flex-col items-center justify-center gap-3 w-full h-48
                          bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl
                          cursor-pointer hover:border-indigo-400 hover:bg-indigo-50/30 transition group">

                {{-- Ikon placeholder sebelum file dipilih --}}
                <div id="placeholder_create" class="flex flex-col items-center gap-2">
                    <svg class="w-10 h-10 text-slate-300 group-hover:text-indigo-400 transition"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2
                                 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0
                                 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-sm font-semibold text-slate-400 group-hover:text-indigo-500">
                        Klik untuk pilih gambar
                    </p>
                </div>

                {{-- Preview gambar tampil setelah file dipilih (via JavaScript) --}}
                <img id="preview_create" src="#" alt="Preview poster"
                     class="hidden w-full h-full object-cover rounded-2xl">
            </label>

            @error('poster')
                <p class="text-red-500 text-sm mt-1.5 font-medium">⚠ {{ $message }}</p>
            @enderror
        </div>

        {{-- TOMBOL AKSI --}}
        <div class="pt-4 flex justify-end gap-4 border-t border-slate-100">
            <a href="{{ route('admin.events.index') }}"
               class="px-6 py-4 text-slate-500 font-bold hover:text-slate-800 transition">
                ← Batal
            </a>
            <button type="submit"
                    class="px-8 py-4 bg-indigo-600 text-white rounded-2xl font-bold
                           shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition">
                Simpan Event
            </button>
        </div>

    </form>
</div>
@endsection

@section('scripts')
<script>
// Preview gambar sebelum form disubmit
// Dipanggil oleh onchange di input[type=file]
function previewImage(input, previewId, placeholderId) {
    const preview     = document.getElementById(previewId);
    const placeholder = document.getElementById(placeholderId);

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');   // tampilkan gambar
            placeholder.classList.add('hidden');  // sembunyikan ikon
        };

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
