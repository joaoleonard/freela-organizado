@extends('layouts.dashboard')

@section('title', 'Disponibilidade')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/availability.css') }}">
@endsection

@section('content')
    <h2>Disponibilidade para tocar</h2>

    <form action="{{ route('set.disponibilidade') }}" method="POST">
        @csrf
        @foreach ($shows as $show)
            <div class="checkbox-group">
                <input class="checkbox" type="checkbox" id="show-{{ $show->id }}" name="shows[]" value="{{ $show->id }}"
                    {{ $show->checked ? 'checked' : '' }}>
                <label for="show-{{ $show->id }}">{{ $show->formatted_date }}</label>
                @if ($show->lunchtime)
                    <p class="lunchtime">* Almoço</p>
                @endif
                <p></p>
            </div>
            @if ($show->isSaturday && !$show->lunchtime)
                <div class="divisor"></div>
            @endif
        @endforeach
        <button type="submit" class="action-btn">Enviar</button>
    </form>
@endsection
