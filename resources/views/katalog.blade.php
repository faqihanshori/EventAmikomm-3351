<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog AmikomEventHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 font-sans antialiased text-gray-800">

    <div class="max-w-5xl mx-auto p-6">
        <nav class="bg-white p-4 mb-8 rounded-xl shadow-md flex flex-wrap justify-center gap-3">
            <a href="/" class="px-5 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition shadow">Home</a>
            <a href="/profil" class="px-5 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition shadow">Profil</a>
            <a href="/katalog" class="px-5 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition shadow">Katalog</a>
            <a href="/bantuan" class="px-5 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition shadow">Bantuan</a>
            <a href="/kontak" class="px-5 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition shadow">Kontak</a>
        </nav>

        <h1 class="text-3xl font-bold text-center text-slate-800 mb-8">Katalog Event - AmikomEventHub</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl hover:-translate-y-2 transition duration-300 border border-slate-100">
                <div class="bg-blue-100 h-32 rounded-xl mb-4 flex items-center justify-center text-blue-500 font-medium">Image Placeholder</div>
                <h3 class="text-xl font-bold mb-2">Seminar AI</h3>
                <p class="text-sm text-gray-600 mb-4">Membahas perkembangan Artificial Intelligence di masa depan.</p>
                <button class="w-full bg-slate-800 text-white py-2 rounded-lg hover:bg-slate-700 transition">Daftar Event</button>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl hover:-translate-y-2 transition duration-300 border border-slate-100">
                <div class="bg-green-100 h-32 rounded-xl mb-4 flex items-center justify-center text-green-500 font-medium">Image Placeholder</div>
                <h3 class="text-xl font-bold mb-2">Workshop Laravel</h3>
                <p class="text-sm text-gray-600 mb-4">Belajar framework PHP terpopuler dari nol hingga mahir.</p>
                <button class="w-full bg-slate-800 text-white py-2 rounded-lg hover:bg-slate-700 transition">Daftar Event</button>
            </div>

             <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl hover:-translate-y-2 transition duration-300 border border-slate-100">
                <div class="bg-orange-100 h-32 rounded-xl mb-4 flex items-center justify-center text-orange-500 font-medium">Image Placeholder</div>
                <h3 class="text-xl font-bold mb-2">Lomba UI/UX</h3>
                <p class="text-sm text-gray-600 mb-4">Ajang kompetisi desain antarmuka mahasiswa nasional.</p>
                <button class="w-full bg-slate-800 text-white py-2 rounded-lg hover:bg-slate-700 transition">Daftar Event</button>
            </div>
        </div>
    </div>

</body>
</html>
