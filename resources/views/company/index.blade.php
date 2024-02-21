@extends('layouts.app')
@section('title', 'Liste des entreprises')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Voici les entreprises</h1>
            </div>
            @foreach($companies as $company)
                @if(count($company->offers) > 0)
                    <div class="col-lg-3 col-md-4 col-sm-12">
                        <div class="card mb-4">
                            <img src="{{ asset($company->logo) }}" class="card-img-top" alt="{{$company->name}}">
                            <div class="card-body">
                                <h5 class="card-title">{{$company->company_name}}</h5>
                                <a href="{{route('company',[$company->slug, $company->id])}}" class="btn btn-primary">Voir
                                    l'entreprise</a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
