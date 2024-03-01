@extends('layouts.admin')

@section('admin_title', 'Offres d\'emploi')

@section('admin_content')
    <h1>Les offres d'emploi</h1>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Entreprise</th>
                <th>Titre</th>
                <th>Contrat</th>
                <th>Présence</th>
                <th>Lieu</th>
                <th>Publiée le</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($offers as $offer)
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
                            @if($offer->active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{route('company.offers', [$offer->slug,$offer->id])}}"
                                   class="btn btn-primary">Voir</a>
                                <a class="btn btn-secondary" href="{{route('admin.offer', [$offer->id])}}">Edit</a>
                            </div>
                        </td>
                    </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
