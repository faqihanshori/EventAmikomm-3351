<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin
        \App\Models\User::create([
            'name'     => 'Admin Amikom',
            'email'    => 'admin@amikom.ac.id',
            'password' => bcrypt('password'),
            'role'     => 'admin',
        ]);

        // 2. Insert 3 Kategori
        $cat1 = \App\Models\Category::create([
            'name' => 'Seminar IT',
            'slug' => 'seminar-it',
        ]);

        $cat2 = \App\Models\Category::create([
            'name' => 'Entertainment',
            'slug' => 'entertainment',
        ]);

        $cat3 = \App\Models\Category::create([
            'name' => 'Workshop',
            'slug' => 'workshop',
        ]);

        // 3. Insert 6 Event

        // Event 1
        \App\Models\Event::create([
            'category_id' => $cat2->id,
            'title'       => 'Jazz Night 2026',
            'description' => 'Nikmati malam yang indah dengan alunan musik jazz yang merdu bersama musisi ternama.',
            'date'        => '2026-05-10 19:00:00',
            'location'    => 'Auditorium AMIKOM, Yogyakarta',
            'price'       => 150000,
            'stock'       => 100,
            'poster_path' => 'posters/concert.png',
        ]);

        // Event 2
        \App\Models\Event::create([
            'category_id' => $cat1->id,
            'title'       => 'Hackathon - Unleash Your Inner Developer',
            'description' => 'Ayo asah skill coding kamu dan ciptakan solusi inovatif untuk tantangan masa depan!',
            'date'        => '2026-05-05 10:00:00',
            'location'    => 'Inkubator AMIKOM, Yogyakarta',
            'price'       => 0,
            'stock'       => 150,
            'poster_path' => 'posters/hackathon.png',
        ]);

        // Event 3
        \App\Models\Event::create([
            'category_id' => $cat1->id,
            'title'       => 'AI & Future Tech Summit 2026',
            'description' => 'Jelajahi tren terkini dalam kecerdasan buatan dan teknologi masa depan bersama para ahli.',
            'date'        => '2026-05-01 13:00:00',
            'location'    => 'Cinema Unit 6, AMIKOM',
            'price'       => 50000,
            'stock'       => 200,
            'poster_path' => 'posters/workshop.png',
        ]);

        // Event 4
        \App\Models\Event::create([
            'category_id' => $cat3->id,
            'title'       => 'UI/UX Masterclass: Design Thinking',
            'description' => 'Pelajari prinsip dasar desain antarmuka yang menarik dan berpusat pada pengguna.',
            'date'        => '2026-06-15 09:00:00',
            'location'    => 'Lab Komputer AMIKOM, Yogyakarta',
            'price'       => 75000,
            'stock'       => 50,
            'poster_path' => 'posters/workshop.png',
        ]);

        // Event 5
        \App\Models\Event::create([
            'category_id' => $cat2->id,
            'title'       => 'E-Sport U-Champ Tournament 2026',
            'description' => 'Turnamen e-sport antar mahasiswa dengan total hadiah jutaan rupiah. Daftarkan timmu sekarang!',
            'date'        => '2026-06-20 10:00:00',
            'location'    => 'GOR AMIKOM, Yogyakarta',
            'price'       => 100000,
            'stock'       => 64,
            'poster_path' => 'posters/hackathon.png',
        ]);

        // Event 6
        \App\Models\Event::create([
            'category_id' => $cat3->id,
            'title'       => 'Digital Marketing Bootcamp',
            'description' => 'Kuasai strategi pemasaran digital mulai dari SEO, media sosial, hingga iklan berbayar.',
            'date'        => '2026-07-05 08:00:00',
            'location'    => 'Ruang Seminar A, AMIKOM',
            'price'       => 200000,
            'stock'       => 80,
            'poster_path' => 'posters/workshop.png',
        ]);
    }
}
