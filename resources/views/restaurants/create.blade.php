@extends('layouts.dashboard')

@section('title', 'Cadastrar Restaurante')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
    <h2>Cadastrar restaurante</h2>

    <form action="{{ route('restaurants.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="address">Endereço:</label>
            <input type="text" id="address" name="address" required>
        </div>
        <div class="form-group">
            <label for="city">Cidade:</label>
            <input type="text" id="city" name="city" required>
        </div>
        <div class="form-group">
            <label for="admin_id">Admin:</label>
            <select id="admin_id" name="admin_id" required>
                <option value="" disabled selected>Selecione um admin</option>
                @foreach ($admins as $admin)
                    <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                @endforeach
            </select>
        </div>
        <button class="action-btn" type="submit">Cadastrar</button>
    </form>

    <button class="action-btn back-button" data-go_to="/restaurants" type="submit">Voltar</button>
@endsection
