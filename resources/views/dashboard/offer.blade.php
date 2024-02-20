@extends('layouts.dashboard')
@section('title', $offer->title)
@section('content')
    <div class="container">
        <div class="btn btn-primary" data-bs-target="#update-offer" data-bs-toggle="modal">Modifier mon offre
        </div>
        <div class="row">
            <div class="col-md-12">
                <h1>Mon offre - {{$offer->title}}</h1>
            </div>
        </div>
    </div>
    @include('dashboard.modals.update_offer_modal')
@endsection
