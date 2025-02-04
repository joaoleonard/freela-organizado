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
            </div>
            @if ($show->isSaturday)
                <div class="divisor"></div>
            @endif
        @endforeach
        <button type="submit" class="action-btn">Enviar</button>
    </form>
@endsection
