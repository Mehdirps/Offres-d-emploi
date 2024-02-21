@extends('layouts.dashboard')
@section('title', $offer->title)
@section('content')
    <div class="container">
        <div class="btn btn-primary" data-bs-target="#update-offer" data-bs-toggle="modal">Modifier mon offre
        </div>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <h1>Mon offre - {{$offer->title}}
                    @if($offer->active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Inactive</span>
                    @endif
                </h1>
                <p><strong>Description courte :</strong> {!! nl2br(e($offer->short_description)) !!}</p>
                <p><strong>Description :</strong> {!! nl2br(e($offer->description)) !!}</p>
                <p><strong>Type de contrat :</strong> {{$offer->contract_type}}</p>
                <p><strong>Salaire minimum :</strong> {{$offer->annual_salary_minumun}} €</p>
                <p><strong>Salaire maximum :</strong> {{$offer->annual_salary_maximun}} €</p>
                <p><strong>Avantages :</strong> {!! nl2br(e($offer->advantages)) !!}</p>
                <p><strong>Localisation :</strong> {{$offer->city}}</p>
                <p><strong>Type de présence :</strong> {{$offer->location}}</p>
                <p><strong>Experience :</strong> {!! nl2br(e($offer->experience)) !!}</p>
                <p><strong>Langues :</strong> {!! nl2br(e($offer->languages_required)) !!}</p>
            </div>
        </div>
    </div>
    @include('dashboard.modals.update_offer_modal')
@endsection
@section('footer_script')
    <script>
        $(document).ready(function () {
            if (window.location.hash === '#update-offer') {
                $('#update-offer').modal('show');
            }
        });
    </script>
@endsection
