<html>
    <head>
        <title>Perpustakaan</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <nav class="bg-purple-950 border-b border-purple-800 shadow-lg">
    <ul class="flex items-center gap-2 px-6 py-4">
        <li>
            <a href="{{ route('kategori.index') }}"
               class="px-4 py-2 text-purple-200 rounded-lg hover:bg-purple-800 hover:text-white transition">
                Kategori
            </a>
        </li>

        <li>
            <a href="{{ route('buku.index') }}"
               class="px-4 py-2 text-purple-200 rounded-lg hover:bg-purple-800 hover:text-white transition">
                Buku
            </a>
        </li>

        <li>
            <a href="{{ route('member.index') }}"
               class="px-4 py-2 text-purple-200 rounded-lg hover:bg-purple-800 hover:text-white transition">
                Member
            </a>
        </li>
    </ul>
</nav>
<div class="background-shapes">
    <div class="shape shape-one"></div>
    <div class="shape shape-two"></div>
    <div class="shape shape-three"></div>
</div>
        @yield('content')
    </body>
</html>