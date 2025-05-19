@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/restaurants.css') }}">
@endsection

@section('content')
    <div class="title-container">
        <h2>Restaurantes</h2>

        <a href="{{ route('restaurants.create') }}" class="add-button">+</a>
    </div>

    <div class="shows-container">
        @if ($restaurants->isEmpty())
            <h3>Nenhum restaurante cadastrado ainda</h3>
        @endif
        @foreach ($restaurants as $restaurant)
            <div class="restaurant-box" data-restaurant_id="{{ $restaurant->id }}">
                <h1>{{ $restaurant->name }}</h1>
            </div>
        @endforeach
    </div>

    <button class="action-btn back-button" data-go_to="/dashboard" type="submit">Voltar</button>
@endsection
