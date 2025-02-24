@extends('layouts.dashboard')

@section('title', 'Editar Show')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
    <h2>Editar Show</h2>

    <h3>{{ $show->formatted_date }}</h3>

    <form action="{{ route('shows.update', ['id' => $show->id]) }}" method="POST"class="form-container">
        @csrf

        <div class="form-group">
            <label for="user_id">Músico:</label>
            <select id="user_id" name="user_id">
                <option value="">Selecione um usuário</option>
                @foreach ($show->users as $user)
                    <option value="{{ $user->id }}" name="user_id" {{ $show->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button class="action-btn" type="submit">Salvar</button>
    </form>

    <form action="{{ route('shows.destroy', ['id' => $show->id]) }}" method="POST" class="form-container">
        @csrf
        @method('DELETE')
        <button type="submit" class="action-btn error-btn">Deletar Data</button>
    </form>
    <button class="action-btn back-button" type="submit">Voltar</button>
@endsection
