@extends('layouts.app')
@section('title', 'Inscription')
@section('content')
    <div class="container">
        <h1>Inscription entreprise</h1>
        <form action="{{route('auth.register.company')}}" method="post">
            @csrf
            @method('post')
            <h2>Vos informations</h2>
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
                    <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}">
                    @error('phone')
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
            <h2>Information de votre entreprise</h2>
            <div class="row">
                <div class="col-md-6">
                    <label for="company_name" class="form-label">Nom de votre entreprise</label>
                    <input type="text" class="form-control" id="company_name" name="company_name" value="{{old('company_name')}}">
                    @error('company_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="activity" class="form-label">Activité de votre entreprise</label>
                    <input type="text" class="form-control" id="activity" name="activity" value="{{old('activity')}}">
                    @error('activity')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="company_email" class="form-label">Adresse e-mail de votre entreprise</label>
                    <input type="email" class="form-control" id="company_email" name="company_email" value="{{old('company_email')}}">
                    @error('company_email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="company_phone" class="form-label">Numéro de téléphone de votre entreprise</label>
                    <input type="text" class="form-control" id="company_phone" name="company_phone" value="{{old('company_phone')}}">
                    @error('company_phone')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="website" class="form-label">Site Web de votre entreprise</label>
                    <input type="url" class="form-control" id="website" name="website" value="{{old('website')}}">
                    @error('website')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="address" class="form-label">Adresse</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{old('address')}}">
                    @error('address')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="postal_code" class="form-label">Code Postal</label>
                    <input type="number" class="form-control" id="postal_code" name="postal_code" value="{{old('postal_code')}}">
                    @error('zipcode')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="city" class="form-label">Ville</label>
                    <input type="text" class="form-control" id="city" name="city" value="{{old('city')}}">
                    @error('city')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">M'inscrire</button>
        </form>
    </div>
@endsection
