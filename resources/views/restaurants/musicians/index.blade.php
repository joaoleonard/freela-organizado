@extends('layouts.dashboard')

@section('title', 'Usuários')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/users.css') }}">
@endsection

@section('content')
    <div class="button-group">
        <a href="{{ route('restaurant.musicians.add', $restaurant->id) }}" class="action-btn">Vincular Novo Músico</a>
    </div>

    <h2>Usuários - {{ $restaurant->name }}</h2>

    @if ($musicians->isEmpty())
        <h3>Nenhum músico vinculado ainda</h3>
    @endif
    @foreach ($musicians as $musician)
        <div class="user-card" data-user_id="{{ $musician->id }}">
            <h3>{{ $musician->name }}</h3>

            <div class="user-infos-container">
                <div class="user-infos">
                    <p><strong>Telefone:</strong> {{ $musician->phone }}</p>
                    <p><strong>Pix:</strong> {{ $musician->pix }}</p>
                </div>
                <form action="{{ route('restaurant.musicians.remove', [$restaurant->id, $musician->id]) }}" method="POST"
                    class="remove-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="unlink-button">X</button>
                </form>
            </div>
        </div>
    @endforeach

    <button class="action-btn back-button" data-go_to="/restaurants/{{ $restaurant->id }}" type="submit">Voltar</button>
@endsection
