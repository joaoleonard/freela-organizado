@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('content')
    <div class="button-group">
        @if (auth()->user()->isMaster())
            <a href="{{ route('users') }}" class="action-btn">Gerenciar Usuários</a>
            <a href="{{ route('restaurants') }}" class="action-btn">Restaurantes</a>
        @elseif (auth()->user()->isAdmin())
            <a href="{{ route('users') }}" class="action-btn">Músicos</a>
        @elseif (auth()->user()->isMusician())
            <a href="{{ route('users.show', auth()->user()->id) }}" class="action-btn outline-btn">Atualizar Meus
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
                <h3>{{ $show->isToday ? 'Hoje' : $show->formatted_date }} {{ $show->lunchtime ? '- almoço' : '' }}</h3>
                <div class="restaurant-infos">
                    <p class="restaurant-name">{{ $show->restaurant->name }}</p>
                    @if (auth()->user()->isMusician())
                        <p>{{ $show->restaurant->city }}</p>
                    @else
                        <p><strong>Nome:</strong> {{ $show->user->name }}</p>
                        <p><strong>Telefone:</strong> {{ $show->user->phone }}</p>
                        <p><strong>Pix:</strong> {{ $show->user->pix }}</p>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
@endsection
