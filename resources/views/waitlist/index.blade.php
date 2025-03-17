@extends('layouts.dashboard')

@section('title', 'Lista de Espera')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/waitlist.css') }}">
@endsection

@section('content')
    <h2>Lista de Espera</h2>

    @foreach ($waitlist as $user)
        <div class="musician-waitlist-card" data-user_id="{{ $user->id }}">
            <h3>{{ $user->name }}</h3>

            <div class="user-infos-container">
                <div class="user-infos">
                    <p><strong>Instagram:</strong> {{ $user->instagram }}</p>
                    <p><strong>Telefone:</strong> {{ $user->phone }}</p>
                </div>
                @if ($user->status == 'pending')
                    <div class="pending-icon">!</div>
                @elseif ($user->status == 'approved')
                    <div class="approved-icon">✓</div>
                @elseif ($user->status == 'rejected')
                    <div class="rejected-icon">X</div>
                @endif
            </div>
        </div>
    @endforeach

    <div class="button-group">
        <a href="{{ route('users') }}" class="action-btn outline-btn">Voltar</a>
    </div>
@endsection
