@extends('layouts.dashboard')

@section('title', 'Gerenciar Datas')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/shows.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bg-colors.css') }}">
@endsection

@section('content')
    <div class="title-container">
        <h2>Gerenciar Datas</h2>

        <a href="{{ route('shows.create') }}" class="add-button">+</a>
    </div>

    <div class="shows-container">
        @if ($shows->isEmpty())
            <h3>Nenhuma data cadastrada ainda</h3>
        @endif
        @foreach ($shows as $show)
            <div class="show-box bg-{{ $show->user_id }}" data-show_id="{{ $show->id }}">
                @if ($show->lunchtime)
                    <p class="lunchtime">Almoço</p>
                @endif
                <h3>{{ $show->formatted_date }}</h3>
                <p class="week-day">{{ $show->week_day }}</p>
                <p>{{ $show->user?->name }}</p>
                <div class="available-users-count" title="{{ $show->users->pluck('name')->join("\n") }}">
                    <p>{{ $show->users->count() }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
