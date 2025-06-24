@extends('layouts.dashboard')

@section('title', 'Disponibilidade')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/availability.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('js/availability.js') }}"></script>
@endsection

@section('content')
    <h2>Disponibilidade para tocar</h2>

    @if ($restaurants->isEmpty())
        <h3>Nenhum restaurante vinculado</h3>
    @else
        <div id="restaurant-boxes">
            @foreach ($restaurants as $restaurant)
                <div class="restaurant-selector" data-id="restaurant-{{ $restaurant->id }}">
                    <strong>{{ $restaurant->name }}</strong>
                </div>
            @endforeach
        </div>

        <form action="{{ route('set.disponibilidade') }}" method="POST">
            @csrf
            @foreach ($restaurants as $restaurant)
                <div id="restaurant-{{ $restaurant->id }}" class="restaurant-dates">
                    @if ($restaurant->shows->isEmpty())
                        <div class="no-shows">
                            <p>Não há shows disponíveis para o restaurante {{ $restaurant->name }}</p>
                        </div>
                    @endif
                    @foreach ($restaurant->shows as $show)
                        <div class="checkbox-group">
                            <input class="checkbox" type="checkbox" id="show-{{ $show->id }}" name="shows[]"
                                value="{{ $show->id }}" {{ $show->checked ? 'checked' : '' }}>
                            <label for="show-{{ $show->id }}">{{ $show->formatted_date }}</label>
                            @if ($show->show_time)
                                <p class="lunchtime"> {{$show->show_time}}</p>
                            @endif
                            <p></p>
                        </div>
                        @if ($show->isSaturday && !$show->lunchtime)
                            <div class="divisor"></div>
                        @endif
                    @endforeach
                </div>
            @endforeach
            <button type="submit" class="action-btn">Enviar</button>
        </form>
    @endif

    <button class="action-btn back-button" data-go_to="/dashboard" type="submit">Voltar</button>
@endsection
