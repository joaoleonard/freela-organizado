<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <script src="{{ asset('js/index.js') }}" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    @include('components.header')

    <main class="dashboard-container">
        @if (auth()->user()->isMusician())
            <h2>Minhas datas</h2>
        @else
            <h2>Agenda Musical</h2>
        @endif

        @if ($shows->isEmpty())
            <h3>Nenhuma data cadastrada ainda</h3>
        @else
            @foreach ($shows as $show)
                <div class="{{ $show->isToday ? 'is-today-show-card' : 'show-card' }}">
                    <h3>{{ $show->formatted_date }}</h3>
                    @if ($show->user)
                        <div class="user-infos">
                            <p class="musician-name">{{ $show->user->name }}</p>
                            <p><strong>Telefone:</strong> {{ $show->user->phone }}</p>
                            <p><strong>Pix:</strong> joao@email.com</p>
                        </div>
                    @endif
                </div>
            @endforeach
        @endif

        <div class="button-group">
            @if (auth()->user()->isMaster())
                <a href="{{ route('shows') }}" class="action-btn">Gerenciar Datas</a>
                <a href="{{ route('users') }}" class="action-btn">Gerenciar Usuários</a>
            @elseif (auth()->user()->isMusician())
                <a href="{{ route('disponibilidade') }}" class="action-btn">Preencher Disponibilidade</a>
            @endif
        </div>
    </main>

    @if (session('success'))
        <div class="popup-message">
            {{ session('success') }}
        </div>
    @endif
</body>

</html>
