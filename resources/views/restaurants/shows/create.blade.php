@extends('layouts.dashboard')

@section('title', 'Cadastrar Show')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
    <h2>Cadastrar Show</h2>

    <form action="{{ route('restaurant.shows.store', $restaurant->id) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="show_date">Data do Show:</label>
            <input type="date" id="show_date" name="show_date" required>
        </div>

        <div class="form-group">
            <label for="show_time">Hora do Show:</label>
            <select id="show_time" name="show_time" required class="select">
                <option value="12:00">12:00</option>
                <option value="12:30">12:30</option>
                <option value="19:00">19:00</option>
                <option value="19:30">19:30</option>
                <option value="20:00">20:00</option>
            </select>
        </div>

        <button class="action-btn" type="submit">Cadastrar</button>
    </form>

    <button class="action-btn back-button" data-go_to="/restaurants/{{ $restaurant->id }}/shows"
        type="submit">Voltar</button>
@endsection
