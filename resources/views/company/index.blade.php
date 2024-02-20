@extends('layouts.app')
@section('title', 'Liste des entreprises')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Voici les entreprises</h1>
            </div>
            @foreach($companies as $company)
                <h2>{{$company->name}}</h2>
                <p>{{$company->description}}</p>
                <a href="{{route('company', $company->id)}}">Voir l'entreprise</a>
            @endforeach
        </div>
    </div>
@endsection
