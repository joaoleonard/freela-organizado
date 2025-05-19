@extends('layouts.dashboard')

@section('title', 'Vincular Músico')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
    <h2>Vincular Novo Músico</h2>

    <form action="{{ route('restaurant.musicians.link', $restaurant->id) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="musician_id">Músico:</label>
            <select id="musician_id" name="musician_id">
                <option value="">Selecione um usuário</option>
                @foreach ($musicians as $musician)
                    <option value="{{ $musician->id }}" name="musician_id">
                        {{ $musician->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="action-btn" type="submit">Cadastrar</button>
    </form>

    <button class="action-btn back-button" data-go_to="/restaurants/{{ $restaurant->id }}/users"
        type="submit">Voltar</button>
@endsection
