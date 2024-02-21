@extends('layouts.app')
@section('title', 'Inscription')
@section('content')
    <div class="container">
        <h1>Inscription candidat</h1>
        <form action="{{route('auth.register.user')}}" method="post">
            @csrf
            @method('post')
            <div class="row">
                <div class="col-md-6">
                    <label for="last_name" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{old('last_name')}}">
                    @error('last_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="first_name" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{old('first_name')}}">
                    @error('first_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="email" class="form-label">Adresse e-mail</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="phone" class="form-label">Numéro de téléphone</label>
                    <input type="number" class="form-control" id="phone" name="phone" value="{{old('phone')}}">
                    @error('number')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password">
                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">M'inscrire</button>
        </form>
    </div>
@endsection
