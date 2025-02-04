@extends('layouts.dashboard')

@section('title', 'Cadastrar Show')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
    <h2>Cadastrar Show</h2>

    <form action="{{ route('shows.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="show_date">Data do Show:</label>
            <input type="date" id="show_date" name="show_date" required>
        </div>
        <button class="action-btn" type="submit">Cadastrar</button>
    </form>
@endsection
