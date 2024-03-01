@extends('layouts.admin')

@section('admin_title', 'Les entreprises')

@section('admin_content')
    <section class="container">
        <h1>Les utilisateurs</h1>
        <p>Voici la liste des utilisateurs enregistrés dans la base de données.</p>
        <div class="col-md-12">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#searchUsersModal">
                Rechercher un utilisateurs
            </button>
        </div>
        @if(count($users) === 0)
            <div class="alert alert-info">Aucune utilisateurs n'a été enregistrée pour le moment ou ne correspond à votre recherche.</div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Identifiant</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Créé le</th>
                        <th>E-mail vérifié le</th>
                        <th>Rôle</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        @if($user->role != 'admin')

                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->created_at}}</td>
                            <td>{{ $user->email_verified_at}}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <a href="{{ route('admin.user', $user->id) }}" class="btn btn-warning">Modifier</a>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {{ $users->links('partials.pagination') }}
                </div>
            </div>
        @endif
    </section>
@endsection

@section('admin_footer')
    <script>
        document.querySelectorAll('.delete_company').forEach(form => {
            form.addEventListener('submit', e => {
                const company = e.target.getAttribute('data-company');
                if (!confirm('Voulez-vous vraiment supprimer l\'entreprise ' + company + '?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endsection
