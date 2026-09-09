<html>
    <head>
        <title>Perpustakaan</title>
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="{{ route('kategori.index') }}">Kategori</a></li>
                <li><a href="{{ route('buku.index') }}">Buku</a></li>
                <li><a href="{{ route('member.index') }}">Member</a></li>
            </ul>
        </nav>
        @yield('content')
    </body>
</html>