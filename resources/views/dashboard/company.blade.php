@extends('layouts.dashboard')
@section('title', 'Mon entreprise')
@section('content')
    <div class="container">
        <div class="btn btn-primary" data-bs-target="#edit-company" data-bs-toggle="modal">Modifier les
            informations
        </div>
        <div class="row">
            <div class="col-md-12">
                @if($company->banner)
                    <img style="width: 300px" src="{{ asset($company->banner) }}" alt="Bannière de l'entreprise {{$company->name}}">
                @else
                    <p class="text-danger">Vous n'avez pas de bannière, cliquez sur le bouton si dessus pour en ajouter
                        une</p>
                @endif
                <h1>{{$company->name}}</h1>
                @if($company->logo)
                    <img style="width: 150px" src="{{ asset($company->logo) }}" alt="Logo de l'entreprise {{$company->name}}">
                @else
                    <p class="text-danger">Vous n'avez pas de logo, cliquez sur le bouton si dessus pour en ajouter
                        un</p>
                @endif
                <p>Domaine : <strong>{{$company->activity}}</strong></p>
                <p>Description : <strong>{{$company->description}}</strong></p>
                <p>Localisation : <strong>{{$company->address}} - {{$company->city}}
                        - {{$company->postal_code}}</strong></p>
                <p>Numéro de téléphone : <strong>{{$company->phone}}</strong></p>
                <p>Email : <strong>{{$company->email}}</strong></p>
                <p>Site Web : <strong>{{$company->website}}</strong></p>
            </div>
        </div>
    </div>
    @include('dashboard.modals.update_company_modal')
@endsection
