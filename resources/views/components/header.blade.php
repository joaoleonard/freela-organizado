<header class="header">
    <h1><a href="{{ route('dashboard') }}">Agenda Musical Boussolé</a></h1>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="logout-btn">Sair</button>
    </form>
</header>