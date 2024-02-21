@extends('layouts.app')
@section('title', 'Liste des offres')
@section('content')
    <div class="container">
        <div class="row">
            <h1>Listes des offres via votre recherche <strong>"{{$query}}"</strong></h1>
            <table class="table">
                <thead>
                <tr>
                    <th>Entreprise</th>
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
                            <td>
                                <a href="{{route('company',[$offer->company->slug, $offer->company->id])}}"><img
                                        width="70px" src="{{ asset($offer->company->logo) }}"
                                        alt="Logo de {{ $offer->company->company_name }}"
                                        class="img-thumbnail"></a>
                            </td>
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
    </div>
@endsection
