@extends('layouts.app')
@section('title', $company->company_name)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-1">
                    <img src="{{ asset($company->logo) }}" alt="Logo de {{ $company->company_name }}"
                         class="img-thumbnail">
                </div>
                <h1>{{$company->company_name}}</h1>
                <p>Domaine : <strong>{{$company->activity}}</strong></p>
                <p>Description : <strong>{!! nl2br(e($company->description)) !!}</strong></p>
                <p>Localisation : <strong>{{$company->address}} - {{$company->city}}
                        - {{$company->postal_code}}</strong></p>
                <p>Numéro de téléphone : <strong>{{$company->company_phone}}</strong></p>
                <p>Email : <strong>{{$company->company_email}}</strong></p>
                <p>Site Web : <strong><a href="{{$company->website}}" target="_blank">{{$company->website}}</a></strong></p>
            </div>
        </div>
        <div class="row">
            <h2>Listes des offres</h2>
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
                    @if($offer->active == 1)
                        <tr>
                            <td>{{ $offer->title }}</td>
                            <td>{{ $offer->contract_type }}</td>
                            <td>{{ $offer->location }}</td>
                            <td>{{ $offer->city }}</td>
                            <td>{{ $offer->created_at }}</td>
                            <td>
                                <a href="{{route('company.offers', [$offer->slug,$offer->id])}}" class="btn btn-primary">Voir</a>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

