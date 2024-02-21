@extends('layouts.app')
@section('title', 'Accueil')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <h1>Bienvenue</h1>
                <p>Vous êtes sur la page d'accueil de notre site. Vous pouvez consulter les offres d'emploi, les entreprises
                    et vous inscrire pour postuler à une offre d'emploi.</p>
            </div>
        </div>
    </div>
@endsection
