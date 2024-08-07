@php
    if(Auth::user()){
        $hasApplied = \App\Models\ApplyOffer::where('user_id', Auth::user()->id)
                                             ->where('offer_id', $offer->id)
                                             ->exists();
    }else{
        $hasApplied = false;
    }
@endphp
@extends('layouts.app')
@section('title', $offer->title . ' - ' . $company->company_name)
@section('content')
    <div class="container">
        <div class="col-md-1">
            <img src="{{ asset($company->logo) }}" alt="Logo de {{ $company->company_name }}"
                 class="img-thumbnail">
        </div>
        <h1>{{$offer->title}} - <a
                href="{{route('company',[$company->slug, $company->id])}}">{{$company->company_name}}</a></h1>
        <p>Ajoute le : {{$offer->created_at}}</p>
        <div class="row">
            @if(!$hasApplied)
                <button type="button" class="btn btn-primary col-md-3" data-bs-toggle="modal"
                        data-bs-target="#applyModal">
                    Postuler
                </button>
            @endif
            @if(Auth::user() && Auth::user()->role === "candidat" && \Illuminate\Support\Facades\Auth::user()->email_verified_at)
                @if(Auth::user()->favoriteOffers->contains($offer->id))
                    <form action="{{route('offer.remove.favorite', $offer->id)}}" method="post" class="col-md-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Retirer des favoris</button>
                    </form>
                @else
                    <form action="{{route('offer.add.favorite', $offer->id)}}" method="post" class="col-md-3">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-success">Ajouter aux favoris</button>
                    </form>
                @endif
            @endif
        </div>
        @if(session('error'))
            <div class="alert alert-danger mt-3">
                {{session('error')}}
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success mt-3">
                {{session('success')}}
            </div>
        @endif
        <div class="table-responsive">
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
    </div>
    @include('partials.apply_offer_modal')
@endsection
