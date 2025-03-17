<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar - Lista de Espera</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/index.js') }}" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container waitinglist-container">
        <div class="box">
            <h2>Cadastro Concluído</h2>

            <p>Muito obrigado <strong> {{ $user_name }}</strong>, por se cadastrar na nossa <strong>Lista de
                    Espera.</strong></p>

            <p>Ter seus dados na nossa <strong>Lista de Espera</strong> é muito importante para quando precisarmos de novos músicos.</p>
        </div>
    </div>
</body>

</html>
