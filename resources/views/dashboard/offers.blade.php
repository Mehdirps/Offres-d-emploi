@extends('layouts.dashboard')
@section('title', 'Mes offres d\'emploi')
@section('content')
    <div class="container">
        <div class="btn btn-primary" data-bs-target="#add-offer" data-bs-toggle="modal">Ajouter une offre
        </div>
        <div class="row">
            <div class="col-md-12">
                <h1>Mes offres d'emplois</h1>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Titre</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($offers as $offer)
                        <tr>
                            <td>{{ $offer->title }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{route('dashboard.offer', $offer->id)}}" class="btn btn-success">Voir</a>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#update-offer">Modifier
                                    </button>
                                    <button type="button" class="btn btn-danger">Supprimer</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('dashboard.modals.add_offer_modal')
@endsection
