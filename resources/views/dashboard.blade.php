@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection


@section('content')
    <div class="button-group">
        @if (auth()->user()->isMaster())
            <a href="{{ route('shows') }}" class="action-btn">Gerenciar Datas</a>
            <a href="{{ route('users') }}" class="action-btn">Gerenciar Usuários</a>
        @elseif (auth()->user()->isAdmin())
            <a href="{{ route('users') }}" class="action-btn">Músicos</a>
        @elseif (auth()->user()->isMusician())
            <a href="{{ route('users.show', ['id' => auth()->user()->id]) }}" class="action-btn outline-btn">Atualizar Meus
                Dados</a>
            <a href="{{ route('disponibilidade') }}" class="action-btn">Preencher Disponibilidade</a>
        @endif
    </div>

    @if (auth()->user()->isMusician())
        <h2>Minhas datas</h2>
    @else
        <h2>Agenda Musical</h2>
    @endif

    @if ($shows->isEmpty())
        <h3>Nenhuma data cadastrada ainda</h3>
    @else
        @foreach ($shows as $show)
            <div class="{{ $show->isToday ? 'is-today-show-card' : 'show-card' }}">
                <h3>{{ $show->formatted_date }}</h3>
                @if ($show->user)
                    <div class="user-infos">
                        <p class="musician-name">{{ $show->user->name }}</p>
                        <p><strong>Telefone:</strong> {{ $show->user->phone }}</p>
                        <p><strong>Pix:</strong> {{ $show->user->pix }}</p>
                    </div>
                @endif
            </div>
        @endforeach
    @endif
@endsection
