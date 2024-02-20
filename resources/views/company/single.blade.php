@extends('layouts.app')
@section('title', $company->name)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{$company->name}}</h1>
                <p>{{$company->description}}</p>
                <p>{{$company->activity}}</p>
                <p>{{$company->address}}</p>
                <p>{{$company->postal_code}}</p>
                <p>{{$company->city}}</p>
            </div>
        </div>
        <div class="row">
            <h2>Listes de offres</h2>
            @foreach($offers as $offer)
                <h3>{{$offer->title}}</h3>
                <p>{{$offer->description}}</p>
                <a href="{{route('offer', $offer->id)}}">Voir l'offre</a>
            @endforeach

        </div>
    </div>
@endsection

