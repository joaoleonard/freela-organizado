@extends('layouts.dashboard')

@section('title', 'Alterar Senha')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
    <h2>Alterar senha de {{ $user->name }}</h2>

    @if (session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('users.update-password', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="current_password">Senha Atual:</label>
            <input type="password" id="current_password" name="current_password" required>
        </div>

        <div class="form-group">
            <label for="password">Nova Senha:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmar Nova Senha:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <button class="action-btn" type="submit">Salvar</button>
    </form>

    <button class="action-btn back-button" data-go_to="/users/{{ $user->id }}" type="submit">Voltar</button>
@endsection
