@extends('layouts.dashboard')
@section('title', 'Mon entreprise')
@section('content')
    <div class="container">
        <div class="btn btn-primary" data-bs-target="#edit-company" data-bs-toggle="modal">Modifier les informations
        </div>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="row">
            <div class="col-md-12">
                @if($company->banner)
                    <img style="width: 100%; height: 200px;object-fit: cover;object-position: center;"
                         src="{{ asset($company->banner) }}" alt="Bannière de l'entreprise {{$company->company_name}}">
                @else
                    <p class="text-danger">Vous n'avez pas de bannière, cliquez sur le bouton si dessus pour en ajouter
                        une</p>
                @endif
                <h1>{{$company->company_name}}</h1>
                @if($company->logo)
                    <img style="width: 150px" src="{{ asset($company->logo) }}"
                         alt="Logo de l'entreprise {{$company->name}}">
                @else
                    <p class="text-danger">Vous n'avez pas de logo, cliquez sur le bouton si dessus pour en ajouter
                        un</p>
                @endif
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>Domaine</th>
                            <td>{{$company->activity}}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{!! nl2br(e($company->description)) !!}</td>
                        </tr>
                        <tr>
                            <th>Localisation</th>
                            <td>{{$company->address}} - {{$company->city}} - {{$company->postal_code}}</td>
                        </tr>
                        <tr>
                            <th>Numéro de téléphone</th>
                            <td>{{$company->company_phone}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$company->company_email}}</td>
                        </tr>
                        <tr>
                            <th>Site Web</th>
                            <td>{{$company->website}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('dashboard.modals.update_company_modal')
@endsection
