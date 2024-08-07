@extends('layouts.app')
@section('title', $company->company_name)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="{{ asset($company->logo) }}" class="card-img" alt="Logo de {{ $company->company_name }}">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h1 class="card-title">{{$company->company_name}}</h1>
                                <p class="card-text"><small class="text-muted">Domaine : </small><strong>{{$company->activity}}</strong></p>
                                <p class="card-text"><small class="text-muted">Description : </small><strong>{!! nl2br(e($company->description)) !!}</strong></p>
                                <p class="card-text"><small class="text-muted">Localisation : </small><strong>{{$company->address}} - {{$company->city}} - {{$company->postal_code}}</strong></p>
                                <p class="card-text"><small class="text-muted">Numéro de téléphone : </small><strong>{{$company->company_phone}}</strong></p>
                                <p class="card-text"><small class="text-muted">Email : </small><strong>{{$company->company_email}}</strong></p>
                                <p class="card-text"><small class="text-muted">Site Web : </small><strong><a href="{{$company->website}}" target="_blank">{{$company->website}}</a></strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @if(count($offers) > 0)
                <h2>Listes des offres</h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Contrat</th>
                            <th>Présence</th>
                            <th>Lieu</th>
                            <th>Publiée le</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($offers as $offer)
                            @if($offer->active)
                                <tr>
                                    <td>{{ $offer->title }}</td>
                                    <td>{{ $offer->contract_type }}</td>
                                    <td>{{ $offer->location }}</td>
                                    <td>{{ $offer->city }}</td>
                                    <td>{{ $offer->created_at }}</td>
                                    <td>
                                        <a href="{{route('company.offers', [$offer->slug,$offer->id])}}"
                                           class="btn btn-primary">Voir</a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="alert alert-info">Aucune offre pour le moment</p>
            @endif
        </div>
    </div>
@endsection

