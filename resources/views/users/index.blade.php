<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
    <link rel="stylesheet" href="{{ asset('css/users.css') }}">
    <script src="{{ asset('js/index.js') }}" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    @include('components.header')

    <main class="dashboard-container">
        <h2>Usuários</h2>

        @foreach ($users as $user)
            <div class="user-card">
                <h3>{{ $user->name }}</h3>

                <div class="user-infos-container">
                    <div class="user-infos">
                        <p><strong>Telefone:</strong> {{ $user->phone }}</p>
                        <p><strong>Pix:</strong> {{ $user->pix }}</p>
                        <p><strong>Função:</strong> {{ $user->role->getFormattedType() }}</p>
                    </div>
                    
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn">X</button>
                    </form>
                </div>
            </div>
        @endforeach

        <div class="button-group">
            @if (auth()->user()->isMaster())
                <a href="{{ route('users.create') }}" class="action-btn">Cadastrar Usuário</a>
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
