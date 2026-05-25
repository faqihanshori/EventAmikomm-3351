@extends('layouts.app')
@section('content')

{{-- ── HERO SECTION ──────────────────────────────────────────── --}}
<section class="max-w-7xl mx-auto px-6 py-20 flex flex-col md:flex-row items-center gap-12">
    <div class="flex-1 space-y-8">
        <span class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 rounded-full text-sm font-bold uppercase tracking-wider">#1
            Event Platform</span>
        <h1 class="text-5xl md:text-7xl font-extrabold leading-tight">
            Temukan &amp; Pesan <span class="text-indigo-600">Tiket Event</span> Impianmu.
        </h1>
        <p class="text-lg text-slate-500 max-w-lg leading-relaxed">
            Dari konser musik hingga workshop teknologi, semua ada di genggamanmu. Pesan aman &amp; cepat dengan
            Midtrans.
        </p>
        <div class="flex gap-4">
            <a href="#events"
                class="px-8 py-4 bg-indigo-600 text-white rounded-2xl font-bold text-lg shadow-xl shadow-indigo-200 hover:scale-105 transition-transform">
                Mulai Jelajah
            </a>
            <a href="#"
                class="px-8 py-4 border-2 border-slate-200 rounded-2xl font-bold text-lg hover:border-indigo-600 hover:text-indigo-600 transition">
                Cara Pesan
            </a>
        </div>
    </div>
    <div class="flex-1 relative">
        <div class="absolute -top-10 -left-10 w-64 h-64 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute -bottom-10 -right-10 w-64 h-64 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        <img src="assets/concert.png" alt="Concert"
            class="rounded-[2rem] shadow-2xl relative z-10 w-full object-cover aspect-[4/5] object-center">
        <div class="absolute -bottom-6 -left-6 glass p-6 rounded-2xl shadow-xl z-20 border border-white">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500 font-bold uppercase">Terverifikasi</p>
                    <p class="font-bold">Pembayaran Aman via Midtrans</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── SOAL 4: SECTION KATEGORI (dari database) ─────────────── --}}
@if($categories->count() > 0)
<section id="kategori" class="max-w-7xl mx-auto px-6 py-10">
    <div class="mb-8">
        <h2 class="text-2xl font-extrabold mb-1">Kategori Event</h2>
        <p class="text-slate-500 text-sm">Temukan event berdasarkan kategori yang kamu minati.</p>
    </div>
    <div class="flex flex-wrap gap-3">
        {{-- @foreach untuk merender semua kategori dari database --}}
        @foreach($categories as $category)
        <a href="#events"
            class="px-5 py-2.5 bg-white border border-slate-200 rounded-2xl text-sm font-semibold text-slate-700
                   hover:bg-indigo-600 hover:text-white hover:border-indigo-600 transition shadow-sm">
            {{ $category->name }}
        </a>
        @endforeach
    </div>
</section>
@endif

{{-- ── EVENTS GRID ────────────────────────────────────────────── --}}
<section id="events" class="max-w-7xl mx-auto px-6 py-20">
    <div class="flex justify-between items-end mb-12">
        <div>
            <h2 class="text-3xl font-extrabold mb-2">Event Terdekat</h2>
            <p class="text-slate-500 font-medium">Jangan sampai ketinggalan acara seru minggu ini!</p>
        </div>
        <div class="flex gap-2">
            <button class="p-3 border rounded-xl hover:bg-white hover:shadow-md transition">Semua Kategori</button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Event Card 1 -->
        <div class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden">
            <div class="relative overflow-hidden aspect-[3/4]">
                <img src="assets/concert.png" alt="Jazz Night"
                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                <div class="absolute top-4 left-4 px-3 py-1 bg-white/90 backdrop-blur rounded-lg text-xs font-bold uppercase text-indigo-600">
                    Musik</div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold mb-2 group-hover:text-indigo-600 transition">Jazz Night 2024: A Celebration</h3>
                <div class="flex items-center gap-2 text-slate-500 text-sm mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>16 November 2024, 19:30</span>
                </div>
                <div class="flex justify-between items-center pt-4 border-t">
                    <span class="text-2xl font-black text-indigo-600">Rp 150rb</span>
                    <a href="{{ route('events.show', 1) }}"
                        class="px-5 py-2 bg-indigo-50 text-indigo-600 rounded-xl font-bold hover:bg-indigo-600 hover:text-white transition">Lihat Detail</a>
                </div>
            </div>
        </div>

        <!-- Event Card 2 -->
        <div class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden">
            <div class="relative overflow-hidden aspect-[3/4]">
                <img src="assets/workshop.png" alt="AI & Future"
                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                <div class="absolute top-4 left-4 px-3 py-1 bg-white/90 backdrop-blur rounded-lg text-xs font-bold uppercase text-indigo-600">
                    Technology</div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold mb-2 group-hover:text-indigo-600 transition">AI &amp; Future: Unleash The Power</h3>
                <div class="flex items-center gap-2 text-slate-500 text-sm mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>26 October 2024, 09:00</span>
                </div>
                <div class="flex justify-between items-center pt-4 border-t">
                    <span class="text-2xl font-black text-indigo-600">Rp 50rb</span>
                    <a href="{{ route('events.show', 2) }}"
                        class="px-5 py-2 bg-indigo-50 text-indigo-600 rounded-xl font-bold hover:bg-indigo-600 hover:text-white transition">Lihat Detail</a>
                </div>
            </div>
        </div>

        <!-- Event Card 3 -->
        <div class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden">
            <div class="relative overflow-hidden aspect-[3/4]">
                <img src="assets/hackathon.png" alt="Hackathon 2024"
                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                <div class="absolute top-4 left-4 px-3 py-1 bg-white/90 backdrop-blur rounded-lg text-xs font-bold uppercase text-indigo-600">
                    Coding</div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold mb-2 group-hover:text-indigo-600 transition">Hackathon 2024: Ultimate Marathon</h3>
                <div class="flex items-center gap-2 text-slate-500 text-sm mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>18-20 October 2024</span>
                </div>
                <div class="flex justify-between items-center pt-4 border-t">
                    <span class="text-2xl font-black text-indigo-600">Gratis</span>
                    <a href="{{ route('events.show', 3) }}"
                        class="px-5 py-2 bg-indigo-50 text-indigo-600 rounded-xl font-bold hover:bg-indigo-600 hover:text-white transition">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── SOAL 4: SECTION PARTNER (dari database) ──────────────── --}}
<section id="partner" class="max-w-7xl mx-auto px-6 py-16">
    <div class="text-center mb-10">
        <h2 class="text-3xl font-extrabold mb-2">Partner &amp; Sponsor Kami</h2>
        <p class="text-slate-500 font-medium">Mereka yang mendukung terselenggaranya AmikomEventHub.</p>
    </div>

    @if($partners->count() > 0)
    {{-- @foreach untuk merender semua partner dari database --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
        @foreach($partners as $partner)
        <div class="group bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-lg
                    transition-all duration-300 p-6 flex flex-col items-center justify-center gap-3
                    hover:-translate-y-1">
            {{-- Logo Partner --}}
            @if($partner->logo_url)
                <img src="{{ $partner->logo_url }}"
                    alt="{{ $partner->name }}"
                    class="h-12 w-auto object-contain grayscale group-hover:grayscale-0 transition duration-300"
                    onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($partner->name) }}&background=e0e7ff&color=4f46e5&size=64'">
            @else
                <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center
                            text-indigo-600 font-black text-lg group-hover:bg-indigo-600
                            group-hover:text-white transition duration-300">
                    {{ strtoupper(substr($partner->name, 0, 2)) }}
                </div>
            @endif
            {{-- Nama Partner --}}
            <p class="text-xs font-bold text-slate-600 text-center group-hover:text-indigo-600 transition">
                {{ $partner->name }}
            </p>
        </div>
        @endforeach
    </div>
    @else
    {{-- Tampilkan pesan jika belum ada partner --}}
    <div class="text-center py-12 text-slate-400">
        <svg class="w-12 h-12 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        <p class="font-medium">Belum ada data partner yang ditambahkan.</p>
        <p class="text-sm mt-1">Tambahkan partner melalui <a href="{{ route('admin.partners.create') }}" class="text-indigo-600 underline font-semibold">panel Admin</a>.</p>
    </div>
    @endif
</section>

@endsection

