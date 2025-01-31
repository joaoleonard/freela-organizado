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
        <h2>Cadastrar Show</h2>

        <form action="{{ route('shows.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="show_date">Data do Show:</label>
                <input type="date" id="show_date" name="show_date" required>
            </div>
            <button class="action-btn" type="submit">Cadastrar</button>
        </form>
    </main>
</body>

</html>
