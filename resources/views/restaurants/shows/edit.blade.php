@extends('layouts.dashboard')

@section('title', 'Editar Show')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
    <h2>Editar Show</h2>

    <div>
        <h3>{{ $show->formatted_date }}</h3>

        @if ($show->lunchtime)
            <span class="lunchtime">almoço</span>
        @endif
    </div>

    <form action="{{ route('restaurant.shows.update', [$restaurant->id, $show->id]) }}" method="POST" class="form-container">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="user_id">Músico:</label>
            <select id="user_id" name="user_id">
                <option value="">Selecione um usuário</option>
                @foreach ($show->users as $user)
                    <option value="{{ $user->id }}" name="user_id" {{ $show->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
                <option value="" disabled>-------- Outros músicos --------</option>
                @foreach ($show->other_users as $user)
                    <option value="{{ $user->id }}" name="user_id" {{ $show->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="show_time">Hora do Show:</label>
            <select id="show_time" name="show_time" required class="select">
                <option value="12:00" {{ $show->show_time == '12:00' ? 'selected' : '' }}>12:00</option>
                <option value="12:30" {{ $show->show_time == '12:30' ? 'selected' : '' }}>12:30</option>
                <option value="19:00" {{ $show->show_time == '19:00' ? 'selected' : '' }}>19:00</option>
                <option value="19:30" {{ $show->show_time == '19:30' ? 'selected' : '' }}>19:30</option>
                <option value="20:00" {{ $show->show_time == '20:00' ? 'selected' : '' }}>20:00</option>
            </select>
        </div>
        <button class="action-btn" type="submit">Salvar</button>
    </form>

    <form action="{{ route('restaurant.shows.destroy', [$restaurant->id, $show->id]) }}" method="POST" class="form-container" id="delete-form">
        @csrf
        @method('DELETE')
    </form>

    <button type="submit" class="action-btn error-btn delete-button">Deletar Data</button>

    <button class="action-btn back-button" data-go_to="/restaurants/{{$restaurant->id}}/shows" type="submit">Voltar</button>
@endsection
