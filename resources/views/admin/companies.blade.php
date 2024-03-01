@extends('layouts.admin')

@section('admin_title', 'Les entreprises')

@section('admin_content')
    <section class="container">
        <h1>Les entreprises</h1>
        <p>Voici la liste des entreprises enregistrées dans la base de données.</p>
        <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Logo</th>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Code postal</th>
                <th>Ville</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Site web</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($companies as $company)
                <tr>
                    <td>
                        @if($company->logo)
                            <img style="width: 50px" src="{{ asset($company->logo) }}"
                                 alt="Logo de l'entreprise {{$company->name}}">
                        @else
                            <p class="text-danger">Aucun</p>
                        @endif
                    </td>
                    <td>{{ $company->company_name }}</td>
                    <td>{{ $company->address }}</td>
                    <td>{{ $company->postal_code }}</td>
                    <td>{{ $company->city }}</td>
                    <td>{{ $company->company_phone }}</td>
                    <td>{{ $company->company_email }}</td>
                    <td>{{ $company->website }}</td>
                    <td>
                        @if($company->active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                    @endif
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('company', [$company->slug, $company->id]) }}" class="btn btn-primary">Voir</a>
                            <a href="{{ route('admin.company', $company->id) }}" class="btn btn-warning">Modifier</a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
        <div class="row">
            <div class="col-md-12">
                {{ $companies->links('partials.pagination') }}
            </div>
        </div>
    </section>
@endsection
