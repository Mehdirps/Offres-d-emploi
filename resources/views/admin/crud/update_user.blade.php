@extends('layouts.admin')

@section('admin_title', 'Modifier un utilisateur - ' . $user->name)

@section('admin_content')
    <section class="container">
        <h1>Modifier l'utilisateur - <strong>{{$user->name}} ({{$user->role}}) </strong></h1>
        <form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Téléphone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                @error('phone')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe (Ne pas remplir si vous ne voulez pas changer de mot de passe)</label>
                <input type="password" class="form-control" id="password" name="password">
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
@endsection
