@extends('layouts.dashboard')
@section('title', $offer->title)
@section('content')
    <div class="container">
        <div class="btn btn-primary" data-bs-target="#update-offer" data-bs-toggle="modal">Modifier mon offre</div>
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
                <table class="table">
                    <tbody>
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
                        <th>Salaire minimum</th>
                        <td>{{$offer->annual_salary_minumun}} €</td>
                    </tr>
                    <tr>
                        <th>Salaire maximum</th>
                        <td>{{$offer->annual_salary_maximun}} €</td>
                    </tr>
                    <tr>
                        <th>Avantages</th>
                        <td>{!! nl2br(e($offer->advantages)) !!}</td>
                    </tr>
                    <tr>
                        <th>Localisation</th>
                        <td>{{$offer->city}}</td>
                    </tr>
                    <tr>
                        <th>Type de présence</th>
                        <td>{{$offer->location}}</td>
                    </tr>
                    <tr>
                        <th>Experience</th>
                        <td>{!! nl2br(e($offer->experience)) !!}</td>
                    </tr>
                    <tr>
                        <th>Langues</th>
                        <td>{!! nl2br(e($offer->languages_required)) !!}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row" id="apply">
            <div class="col-md-12">
                <h2>Listes des candidatures</h2>
                <div class="row">
                    <p id="all" class="btn col-md-3 btn-secondary">Tout</p>
                    <p id="pending" class="btn col-md-3 btn-warning">En attente</p>
                    <p id="accepted" class="btn col-md-3 btn-success">Accepté</p>
                    <p id="refused" class="btn col-md-3 btn-danger">Refusé</p>
                </div>
                @if(count($offer->apply) > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>CV</th>
                                <th>Lettre de motivation</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th>Changer le status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($offer->apply as $item)
                                <tr class="{{ $item->status }} apply_tr">
                                    <td>{{$item->user->name}}</td>
                                    <td>{{$item->user->email}}</td>
                                    <td>
                                        <a href="{{asset($item->curriculum)}}" target="_blank"><i
                                                class="bi bi-file-earmark-text"></i></a>
                                    </td>
                                    <td>
                                        <a href="{{asset($item->cover_letter)}}" target="_blank"><i
                                                class="bi bi-file-earmark-text"></i></a>
                                    </td>
                                    <td>{!! nl2br(e($item->message)) !!}</td>
                                    <td>
                                        @if($item->status === 'pending')
                                            <span class="badge bg-warning">En attente</span>
                                        @elseif($item->status === 'accepted')
                                            <span class="badge bg-success">Accepté</span>
                                        @else
                                            <span class="badge bg-danger">Refusé</span>
                                    @endif
                                    <td>
                                        <form action="{{ route('offer.update.status', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <select class="form-control" name="status" onchange="this.form.submit()">
                                                <option
                                                    value="pending" {{ $item->status === 'pending' ? 'selected' : '' }}>
                                                    En attente
                                                </option>
                                                <option
                                                    value="accepted" {{ $item->status === 'accepted' ? 'selected' : '' }}>
                                                    Accepté
                                                </option>
                                                <option
                                                    value="refused" {{ $item->status === 'refused' ? 'selected' : '' }}>
                                                    Refusé
                                                </option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{route('conversation.store')}}" method="post">
                                            @csrf
                                            @method('POST')
                                            <input type="hidden" name="user_id" value="{{$item->user->id}}">
                                            <input type="hidden" name="offer_id" value="{{$item->offer->id}}">
                                            <input type="hidden" name="company_id"
                                                   value="{{$item->offer->company->id}}">
                                            <button type="submit" class="btn btn-primary">Contacter</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info">Aucune candidature pour le moment</div>
                @endif
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
        $(document).ready(function() {
            $('#pending').click(function() {
                filterOffers('pending');
            });

            $('#accepted').click(function() {
                filterOffers('accepted');
            });

            $('#refused').click(function() {
                filterOffers('refused');
            });

            $('#all').click(function () {
                $('.apply_tr').show();
            });

            function filterOffers(status) {
                $('.apply_tr').each(function() {
                    if ($(this).hasClass(status)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }
        });
    </script>
@endsection
