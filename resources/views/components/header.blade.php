<header class="header">
    <a href="{{ route('dashboard') }}"><img src="{{ asset('logo.png') }}" alt="Logo" class="logo"></a>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="logout-btn">Sair</button>
    </form>
</header>
