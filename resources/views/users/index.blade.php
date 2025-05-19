@extends('layouts.dashboard')

@section('title', 'Usuários')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/users.css') }}">
@endsection

@section('content')
    <div class="button-group">
        <a href="{{ route('users.create') }}" class="action-btn">Cadastrar Usuário</a>
        <a href="{{ route('waitlist') }}" class="action-btn outline-btn waitlist-button">
            Lista de Espera
            @if ($waitlistCount > 0)
                <p class="waitlist-count">{{ $waitlistCount }}</p>
            @endif
        </a>
    </div>

    <h2>Usuários</h2>

    @foreach ($users as $user)
        <div class="user-card" data-user_id="{{ $user->id }}">
            <h3>{{ $user->name }}</h3>

            <div class="user-infos-container">
                <div class="user-infos">
                    <p><strong>Telefone:</strong> {{ $user->phone }}</p>
                    <p><strong>Pix:</strong> {{ $user->pix }}</p>
                    <p><strong>Função:</strong> {{ $user->role->getFormattedType() }}</p>
                </div>
            </div>
        </div>
    @endforeach

    <button class="action-btn back-button" data-go_to="/dashboard" type="submit">Voltar</button>
@endsection
