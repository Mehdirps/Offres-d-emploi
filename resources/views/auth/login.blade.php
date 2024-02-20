@extends('layouts.app')
@section('title', 'Connexion')
@section('content')
    <div class="container">
        <h1>Connexion</h1>
        <form action="{{route('auth.login')}}" method="post">
            @csrf
            @method('post')
            <div class="row">
                <div class="col-md-6">
                    <label for="email" class="form-label">Adresse e-mail</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password">
                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Me connecter</button>
        </form>
    </div>
@endsection
