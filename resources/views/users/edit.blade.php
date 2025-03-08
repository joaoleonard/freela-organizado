@extends('layouts.dashboard')

@section('title', 'Editar Usuário')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
    <h2>{{ $user->name }}</h2>

    <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}" {{ auth()->user()->isAdmin() ? 'readonly' : '' }}
                required>
        </div>
        <div class="form-group">
            <label for="phone">Telefone:</label>
            <input type="text" id="phone" name="phone" value="{{ $user->phone }}"
                {{ auth()->user()->isAdmin() ? 'readonly' : '' }} required>
        </div>
        <div class="form-group">
            <label for="pix">Pix:</label>
            <input type="text" id="pix" name="pix"value="{{ $user->pix }}" {{ auth()->user()->isAdmin() ? 'readonly' : '' }}
                required>
        </div>

        @if (!auth()->user()->isAdmin())
            <button class="action-btn" type="submit">Editar</button>
        @endif
    </form>

    @if (auth()->user()->isMaster())
        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="form-container" id="delete-form">
            @csrf
            @method('DELETE')
        </form>
        <button class="action-btn error-btn delete-button" type="submit">Excluir</button>
    @endif

    <button class="action-btn back-button" type="submit">Voltar</button>
@endsection
