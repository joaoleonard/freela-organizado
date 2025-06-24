@extends('layouts.dashboard')

@section('title', 'Restaurante')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
    <div class="button-group">
        <a href="{{ route('restaurant.musicians', $restaurant->id) }}" class="action-btn">Músicos Vínculados</a>
        <a href="{{ route('restaurant.shows', $restaurant->id) }}" class="action-btn outline-btn">Gerenciar Datas</a>
    </div>

    <h1 class="restaurant-name">{{ $restaurant->name }}</h1>

    <h2>Agenda Musical</h2>

    @if ($shows->isEmpty())
        <h3>Nenhuma data cadastrada ainda</h3>
    @else
        @foreach ($shows as $show)
            <div class="{{ $show->isToday ? 'is-today-show-card' : 'show-card' }}">
                <div>
                    <h3>{{ $show->isToday ? 'Hoje' : $show->formatted_date }}</h3>
                    <p class="show-time">{{ $show->show_time }}</p>
                </div>
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

    @if (auth()->user()->isMaster())
        <form action="{{ route('restaurant.destroy', $restaurant->id) }}" method="POST" class="form-container"
            id="delete-form">
            @csrf
            @method('DELETE')
        </form>
        <button class="action-btn error-btn delete-button" type="submit">Excluir</button>
    @endif

    @if (auth()->user()->isMaster())
        <button class="action-btn back-button" data-go_to="/restaurants" type="submit">Voltar</button>
    @endif
@endsection
