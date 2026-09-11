<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Perpustakaan</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600;700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <nav class="bg-purple-950 border-b border-purple-800 shadow-lg">
            <div class="flex items-center justify-between px-6 py-4">

        <!-- Logo -->
        <a href="{{ route('kategori.index') }}" class="flex items-center gap-3">
            <img src="{{ asset('images/logo.png') }}" alt="Perpustakaan" class="h-10">

            <span class="text-xl font-bold text-purple-200">
                Perpustakaan
            </span>
        </a>
        <!-- Navigation -->
        <ul class="flex items-center gap-2">
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

            </div>
        </nav>

       @if (session('success'))
            <div class="alert-success">
            {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </body>
</html>