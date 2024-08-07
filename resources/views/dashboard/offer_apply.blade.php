@extends('layouts.dashboard')
@section('title', 'Candidatures')
@section('content')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="row" id="apply">
            <div class="col-md-12">
                <h2>Listes des candidatures</h2>
                <div class="row">
                    <p id="all" class="btn col-md-3 btn-secondary">Tout</p>
                    <p id="pending" class="btn col-md-3 btn-warning">En attente</p>
                    <p id="accepted" class="btn col-md-3 btn-success">Accepté</p>
                    <p id="refused" class="btn col-md-3 btn-danger">Refusé</p>
                </div>
                <form>
                    <label for="offers">Trier par offre</label>
                    <select name="offers" id="offers" class="form-control">
                        <option value="all">Toutes les offres</option>
                        @foreach($offers as $offer)
                            <option value="{{$offer->id}}">{{$offer->title}} -
                                @if($offer->active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </option>
                        @endforeach
                    </select>
                </form>
                @if(count($apply) > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Offre</th>
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
                            @foreach($apply as $item)
                                <tr class="{{ $item->status }} apply_tr" data-offer_id="{{$item->offer->id}}">
                                    <td>{{$item->offer->title}}</td>
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
@endsection
@section('footer_script')
    <script>
        $(document).ready(function () {
            if (window.location.hash === '#update-offer') {
                $('#update-offer').modal('show');
            }
        });
        $(document).ready(function () {
            $('#pending').click(function () {
                filterOffers('pending');
            });

            $('#accepted').click(function () {
                filterOffers('accepted');
            });

            $('#refused').click(function () {
                filterOffers('refused');
            });

            $('#all').click(function () {
                $('.apply_tr').show();
            });

            function filterOffers(status) {
                $('.apply_tr').each(function () {
                    $(this).hide();
                    if ($(this).hasClass(status)) {
                        $(this).show();
                    }
                });
            }
        });

        $(document).ready(function () {
            $('#offers').change(function () {
                let offer_id = $(this).val();

                console.log(offer_id)

                if (offer_id) {
                    if (offer_id === 'all') {
                        $('.apply_tr').each(function () {
                            $(this).show();
                        });
                    } else {
                        $('.apply_tr').each(function () {
                            if ($(this).data('offer_id') == offer_id) {
                                $(this).show();
                            } else {
                                $(this).hide();
                            }
                        });
                    }
                } else {
                    $('#apply_tr').show();
                }
            });
        });
    </script>
@endsection
