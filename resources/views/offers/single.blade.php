@extends('layouts.app')
@section('title', $offer->title . ' - ' . $company->company_name)
@section('content')
    <div class="container">
        <div class="col-md-1">
            <img src="{{ asset($company->logo) }}" alt="Logo de {{ $company->company_name }}"
                 class="img-thumbnail">
        </div>
        <h1>{{$offer->title}} - <a href="{{route('company',[$company->slug, $company->id])}}">{{$company->company_name}}</a></h1>
        <table class="table">
            <tr>
                <th>Titre</th>
                <td>{{$offer->title}}</td>
            </tr>
            <tr>
                <th>Description courte</th>
                <td>{!! nl2br(e($offer->short_description)) !!}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td>{!! nl2br(e($offer->description)) !!}</td>
            </tr>
            <tr>
                <th>Type de contrat</th>
                <td>{{$offer->contract_type}}</td>
            </tr>
            <tr>
                <th>Salaire</th>
                <td>De {{$offer->annual_salary_minumun}}€ à {{$offer->annual_salary_maximun}}€</td>
            </tr>
            <tr>
                <th>Avantages</th>
                <td>{!! nl2br(e($offer->advantages)) !!}</td>
            </tr>
            <tr>
                <th>Ville</th>
                <td>{{$offer->city}}</td>
            </tr>
            <tr>
                <th>Emplacement</th>
                <td>{{$offer->location}}</td>
            </tr>
            <tr>
                <th>Expérience</th>
                <td>{!! nl2br(e($offer->experience)) !!}</td>
            </tr>
            <tr>
                <th>Langues requises</th>
                <td>{!! nl2br(e($offer->languages_required)) !!}</td>
            </tr>
        </table>
    </div>
@endsection
