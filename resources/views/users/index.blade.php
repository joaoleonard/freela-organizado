@extends('layouts.dashboard')

@section('title', 'Usuários')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/users.css') }}">
@endsection

@section('content')
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

    <div class="button-group">
        @if (auth()->user()->isMaster())
            <a href="{{ route('users.create') }}" class="action-btn">Cadastrar Usuário</a>
        @endif
    </div>
@endsection


