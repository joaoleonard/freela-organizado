@extends('layouts.dashboard')

@section('title', 'Cadastrar Usuário')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
    <h2>Cadastrar usuário</h2>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="login">Login:</label>
            <input type="text" id="login" name="login" required>
        </div>
        <div class="form-group">
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="phone">Telefone:</label>
            <input type="text" id="phone" name="phone" required>
        </div>
        <div class="form-group">
            <label for="pix">Pix:</label>
            <input type="text" id="pix" name="pix" required>
        </div>
        <div class="form-group">
            <label for="role_id">Função:</label>
            <select id="role_id" name="role_id" required>
                <option value="3">Músico</option>
                <option value="2">Admin</option>
                <option value="1">Master</option>
            </select>
        </div>
        <button class="action-btn" type="submit">Cadastrar</button>
    </form>

    <button class="action-btn back-button" data-go_to="/users" type="submit">Voltar</button>
@endsection
