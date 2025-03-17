<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/index.js') }}" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="box">
            <h2>Entrar</h2>
            <form action="/login" method="POST">
                @csrf
                <div class="form-group">
                    <label for="login">Login</label>
                    <input type="login" id="login" name="login" required>
                </div>
                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="action-btn">Acessar</button>
            </form>
        </div>

        @error('login')
            <div class="popup-message">
                {{ $message }}
            </div>
        @enderror
    </div>
</body>

</html>
