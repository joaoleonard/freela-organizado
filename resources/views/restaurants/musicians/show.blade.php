@extends('layouts.dashboard')

@section('title', 'Editar Usuário')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
    <h2>{{ $musician->name }}</h2>

    <div class="form-group">
        <label for="name">Nome:</label>
        <input type="text" id="name" name="name" value="{{ $musician->name }}" readonly required>
    </div>
    <div class="form-group">
        <label for="phone">Telefone:</label>
        <input type="text" id="phone" name="phone" value="{{ $musician->phone }}" readonly required>
    </div>
    <div class="form-group">
        <label for="pix">Pix:</label>
        <input type="text" id="pix" name="pix"value="{{ $musician->pix }}" readonly required>
    </div>

    @if (auth()->user()->isMaster())
        <h2>Próximos Shows em {{ $restaurant->name }}:</h2>

        @if ($shows->isEmpty())
            <p>Não há shows agendados.</p>
        @else
            <div class="shows-container">
                @foreach ($shows as $show)
                    <div class="show-box {{ $show->isToday ? 'today' : '' }}">
                        <h3>{{ $show->isToday ? 'Hoje' : $show->formatted_date }}</h3>
                        <h3>{{ $show->restaurant->name }}</h3>
                    </div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('restaurant.musicians.remove', [$restaurant->id, $musician->id]) }}" method="POST"
            class="form-container" id="delete-form">
            @csrf
            @method('DELETE')
            <button class="action-btn error-btn delete-button" type="submit">Desvincular Músico</button>
        </form>
    @endif

    <button class="action-btn back-button" data-go_to="/restaurants/{{ $restaurant->id }}/users"
        type="submit">Voltar</button>
@endsection
