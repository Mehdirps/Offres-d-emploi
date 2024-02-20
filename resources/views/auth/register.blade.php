@extends('layouts.app')
@section('title', 'Inscription')
@section('content')
    <div class="container">
        <h1>Inscription</h1>
        <form>
            @csrf
            @method('post')
            <div class="row">
                <div class="col-md-6">
                    <label for="last_name" class="form-label">Nom</label>
                    <input type="email" class="form-control" id="last_name">
                </div>
                <div class="col-md-6">
                    <label for="first_name" class="form-label">Prénom</label>
                    <input type="email" class="form-control" id="first_name">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="company_name" class="form-label">Nom de votre entreprise</label>
                    <input type="email" class="form-control" id="company_name">
                </div>
                <div class="col-md-6">
                    <label for="company_activity" class="form-label">Activité de votre entreprise</label>
                    <input type="password" class="form-control" id="company_activity">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="email" class="form-label">Adresse e-mail</label>
                    <input type="email" class="form-control" id="email">
                </div>
                <div class="col-md-4">
                    <label for="phone" class="form-label">Numéro de téléphone</label>
                    <input type="email" class="form-control" id="phone">
                </div>
                <div class="col-md-4">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="company_address" class="form-label">Adresse</label>
                    <input type="email" class="form-control" id="company_address">
                </div>
                <div class="col-md-4">
                    <label for="company_zipcode" class="form-label">Code Postal</label>
                    <input type="password" class="form-control" id="company_zipcode">
                </div>
                <div class="col-md-4">
                    <label for="company_city" class="form-label">Ville</label>
                    <input type="password" class="form-control" id="company_city">
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">M'inscrire</button>
        </form>
    </div>
@endsection
