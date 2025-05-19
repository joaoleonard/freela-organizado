<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Freela Organizado')</title>
    <link rel="icon" href="{{ asset('logo_icon.png') }}" type="image/png">

    <link rel="stylesheet" href="{{ asset('css/template.css') }}">
    @yield('styles')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <script src="{{ asset('js/index.js') }}" defer></script>
    @yield('scripts')
</head>

<body>
    @include('components.header')

    <main class="dashboard-container">
        @yield('content')
    </main>

    @if (session('success'))
        <div class="popup-message">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="popup-message error">
            {{ session('error') }}
        </div>
    @endif
</body>

</html>
