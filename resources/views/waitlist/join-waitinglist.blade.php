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
            <h2>Lista de Espera</h2>

            <p>Você é músico e gostaria de tocar no Boussolé Rooftop?</p>

            <p>Faça o seu cadastro na nossa <strong>Lista de Espera</strong></p>
            <form action="{{ route('join-waitinglist') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Nome *</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        placeholder="Nome ou nome artístico">
                </div>

                <div class="form-group">
                    <label for="description">Apresentação *</label>
                    <textarea type="description" id="description" name="description"
                        placeholder="Use este campo para se apresentar, falar sobre seu trabalho, onde costuma tocar, seu repertório, etc."
                        rows="3">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="instagram-input">Instagram *</label>
                    <input type="text" id="instagram-input" name="instagram" value="{{ old('instagram') }}" placeholder="@meuinstagram">
                </div>

                <div class="form-group">
                    <label for="phone">Telefone *</label>
                    <input type="text" id="phone" name="phone" placeholder="Telefone" value="{{ old('phone') }}">
                </div>

                <div class="form-group">
                    <label for="extra_link">Link adicional</label>
                    <input type="text" id="extra_link" name="extra_link"
                        placeholder="Site, Youtube, Spotify, etc. (não obrigatório)" value="{{ old('extra_link') }}">
                </div>

                <button type="submit" class="action-btn">Cadastrar</button>
            </form>
        </div>

        @if ($errors->any())
            <div class="popup-message">
                {{ $errors->first() }}
            </div>
        @endif
    </div>
</body>

</html>
