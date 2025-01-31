<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Datas</title>
    <link rel="stylesheet" href="{{ asset('css/shows.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bg-colors.css') }}">
    <script src="{{ asset('js/index.js') }}" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    @include('components.header')

    <main class="dashboard-container">
        <div class="title-container">
            <h2>Gerenciar Datas</h2>

            <a href="{{ route('shows.create') }}" class="add-button">+</a>
        </div>

        <div class="shows-container">
            @if ($shows->isEmpty())
                <h3>Nenhuma data cadastrada ainda</h3>
            @endif
            @foreach ($shows as $show)
                <div class="show-card bg-{{ $show->user_id }}" data-show_id="{{ $show->id }}">
                    <h3>{{ $show->formatted_date }}</h3>
                    <p class="week-day">{{ $show->week_day }}</p>
                    <p>{{ $show->user?->name }}</p>
                </div>
            @endforeach
        </div>
    </main>

    @if (session('success'))
        <div class="popup-message">
            {{ session('success') }}
        </div>
    @endif
</body>

</html>
