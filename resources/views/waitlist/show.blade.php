@extends('layouts.dashboard')

@section('title', 'Editar Usuário')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
    <link rel="stylesheet" href="{{ asset('css/waitlist.css') }}">
@endsection

@section('content')
    <div class="musician-waitlist-info">
        <h2>{{ $user->name }}</h2>
        <p><strong>Descrição:</strong></p>
        <p class="description">{!! nl2br(e($user->description)) !!}</p>
        <p><strong>Telefone:</strong> {{ $user->phone }}</p>
        <p><strong>Instagram:</strong> {{ $user->instagram }}</p>
        @if ($user->extra_link)
            <p><strong>Link extra:</strong> {{ $user->extra_link }}</p>
        @endif
    </div>

    <form action="{{ route('waitlist.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="approved" {{ $user->status == 'approved' ? 'selected' : '' }}>Aprovado</option>
                <option value="rejected" {{ $user->status == 'rejected' ? 'selected' : '' }}>Rejeitado</option>
            </select>
            </select>
        </div>

        <button class="action-btn" type="submit">Salvar</button>
    </form>

    <form action="{{ route('waitlist.destroy', $user->id) }}" method="POST" class="form-container" id="delete-form">
        @csrf
        @method('DELETE')
        <button class="action-btn error-btn delete-button" type="submit">Excluir</button>
    </form>

    <div class="button-group">
        <a href="{{ route('waitlist') }}" class="action-btn outline-btn">Voltar</a>
    </div>
@endsection
