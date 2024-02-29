@extends('layouts.dashboard')
@section('title', 'Mes offres d\'emploi')
@section('content')
    <div class="container">
        <div class="btn btn-primary" data-bs-target="#add-offer" data-bs-toggle="modal">Ajouter une offre
        </div>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="row">
            <div class="col-md-12">
                @if(count($offers) > 0)
                    <h1>Mes offres d'emplois</h1>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Candidatures</th>
                                <th>Nombre de vues</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($offers as $offer)
                                <tr>
                                    <td>{{ $offer->title }}</td>
                                    <td>
                                        <a href="{{route('dashboard.offer', [$offer->slug,$offer->id])}}#apply">{{count($offer->apply)}}</a>
                                    </td>
                                    <td>{{ $offer->seen }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{route('dashboard.offer', [$offer->slug,$offer->id])}}"
                                               class="btn btn-success">Voir</a>
                                            <a href="{{route('dashboard.offer', [$offer->slug,$offer->id])}}#update-offer"
                                               class="btn btn-primary">Modifier</a>
                                            <form class="delete_offer"
                                                  action="{{route('dashboard.offers.delete', $offer->id)}}"
                                                  method="post" data-title="{{$offer->title}}" data-id="{{$offer->id}}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="alert alert-info">Vous n'avez pas encore d'offre d'emploi</p>
                @endif
            </div>
        </div>
    </div>
    @include('dashboard.modals.add_offer_modal')
@endsection
@section('footer_script')
    <script>
        $(document).ready(function () {
            $('.delete_offer').each(function () {
                $(this).submit(function (e) {
                    e.preventDefault();
                    let title = $(this).data('title');
                    if (confirm('Voulez-vous vraiment supprimer l\'offre ' + title + ' ?')) {
                        this.submit();
                    }
                });
            });
        });
    </script>
@endsection
