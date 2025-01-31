<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disponibilidade</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    @include('components.header')

    <main class="dashboard-container">
        <h2>Disponibilidade para tocar</h2>

        <form action="{{ route('set.disponibilidade') }}" method="POST">
            @csrf
            @foreach ($shows as $show)
                <div class="checkbox-group">
                    <input class="checkbox" type="checkbox" id="show-{{ $show->id }}" name="shows[]"
                        value="{{ $show->id }}" {{ $show->checked ? 'checked' : '' }}>
                    <label for="show-{{ $show->id }}">{{ $show->formatted_date }}</label>
                </div>
                @if ($show->isSaturday)
                    <div class="divisor"></div>
                @endif
            @endforeach
            <button type="submit" class="action-btn">Enviar</button>
        </form>
    </main>
</body>

</html>
