<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak - AmikomEventHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 font-sans antialiased text-gray-800">

    <div class="max-w-5xl mx-auto p-6">
        <nav class="bg-white p-4 mb-8 rounded-xl shadow-md flex flex-wrap justify-center gap-3">
            <a href="/" class="px-5 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition shadow">Home</a>
            <a href="/profil" class="px-5 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition shadow">Profil</a>
            <a href="/katalog" class="px-5 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition shadow">Katalog</a>
            <a href="/bantuan" class="px-5 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition shadow">Bantuan</a>
            <a href="/contact" class="px-5 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition shadow">Kontak</a>
        </nav>

        <h1 class="text-3xl font-bold text-center text-slate-800 mb-8">Hubungi Kami</h1>

        <div class="bg-white p-8 rounded-2xl shadow-lg border border-slate-100">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

                <div>
                    <h2 class="text-2xl font-bold mb-4 text-slate-800 border-b pb-2">Informasi Kontak</h2>
                    <p class="text-gray-600 mb-6">
                        Jika Anda memiliki pertanyaan seputar event, pendaftaran, atau kerja sama, jangan ragu untuk menghubungi kami melalui formulir di samping atau melalui kontak di bawah ini.
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-bold shrink-0">@</div>
                            <div>
                                <h4 class="font-semibold text-slate-800">Email</h4>
                                <p class="text-gray-600 text-sm">support@amikomeventhub.com</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-bold shrink-0">WA</div>
                            <div>
                                <h4 class="font-semibold text-slate-800">Telepon / WhatsApp</h4>
                                <p class="text-gray-600 text-sm">+62 812-3456-7890</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-bold shrink-0">Loc</div>
                            <div>
                                <h4 class="font-semibold text-slate-800">Alamat</h4>
                                <p class="text-gray-600 text-sm">Jl. Ring Road Utara, Condongcatur, Yogyakarta, Indonesia</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-50 p-6 rounded-xl border border-slate-200">
                    <form action="#" method="POST" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition" placeholder="Masukkan nama Anda">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition" placeholder="nama@email.com">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pesan</label>
                            <textarea rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition" placeholder="Tulis pertanyaan atau pesan Anda di sini..."></textarea>
                        </div>
                        <button type="submit" class="w-full bg-slate-800 text-white py-2.5 rounded-lg hover:bg-slate-700 transition font-medium shadow-sm hover:shadow-md transform hover:-translate-y-0.5">
                            Kirim Pesan
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

</body>
</html>
