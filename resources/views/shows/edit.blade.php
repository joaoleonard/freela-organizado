<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shows</title>
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    @include('components.header')

    <main class="dashboard-container">
        <h2>Editar Show</h2>

        <h3>{{ $show->formatted_date }}</h3>

        <form action="{{ route('shows.update', ['id' => $show->id]) }}" method="POST"class="form-container">
            @csrf

            <div class="form-group">
                <label for="user_id">Músico:</label>
                <select id="user_id" name="user_id">
                    <option value="">Selecione um usuário</option>
                    @foreach ($show->users as $user)
                        <option value="{{ $user->id }}" name="user_id"
                            {{ $show->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button class="action-btn" type="submit">Salvar</button>
        </form>

        <form action="{{ route('shows.destroy', ['id' => $show->id]) }}" method="POST" class="form-container">
            @csrf
            @method('DELETE')
            <button type="submit" class="action-btn error-btn">Deletar Data</button>
            <a href="{{ route('shows') }}" class="action-btn back-btn">Voltar</a>
        </form>
    </main>
</body>

</html>
