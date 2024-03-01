@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(!$company->active)
                    <div class="alert alert-danger">Votre entreprise a été désactivé par un administrateur. Contactez
                        le service client pour plus d'informations.
                        <br>
                        Votre entreprise ainsi que vos offres d'emploi n'apparaissent plus sur notre site.
                    </div>
                @endif
                <h1>Bonjour {{Auth()->user()->name}}, bienvenue sur le dashboard</h1>
            </div>
        </div>
    </div>
@endsection
