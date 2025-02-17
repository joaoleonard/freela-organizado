@extends('layouts.dashboard')

@section('title', 'Editar Usuário')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
    <h2>{{ $user->name }}</h2>

    <form action="{{ route('users.update', ['id' => $user->id]) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}" readonly="{{ $user->isAdmin() }}" required>
        </div>
        <div class="form-group">
            <label for="phone">Telefone:</label>
            <input type="text" id="phone" name="phone" value="{{ $user->phone }}" readonly="{{ $user->isAdmin() }}" required>
        </div>
        <div class="form-group">
            <label for="pix">Pix:</label>
            <input type="text" id="pix" name="pix"value="{{ $user->pix }}" readonly="{{ $user->isAdmin() }}" required>
        </div>

        @if (!auth()->user()->isAdmin())
            <button class="action-btn" type="submit">Editar</button>
        @endif
    </form>

    @if (auth()->user()->isMaster())
        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="action-btn error-btn" type="submit">Excluir</button>
        </form>
    @endif

    <button class="action-btn back-button" type="submit">Voltar</button>
@endsection
