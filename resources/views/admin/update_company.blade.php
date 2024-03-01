@extends('layouts.admin')

@section('admin_title', 'Modifier une entreprise - ' . $company->company_name)

@section('admin_content')
    <section class="container">
        <h1>Modifier l'entreprise - <strong>{{$company->company_name}}</strong></h1>
        <form action="{{ route('admin.company.update', $company->id) }}" method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="mb-3">
                <label for="company_name" class="form-label">Nom de l'entreprise</label>
                <input type="text" class="form-control" id="company_name" name="company_name" value="{{ $company->company_name }}">
                @error('company_name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="activity" class="form-label">Domaine d'activité</label>
                <input type="text" class="form-control" id="activity" name="activity"
                       value="{{ $company->activity }}">
                @error('activity')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description"
                          name="description">{{ $company->description }}</textarea>
                @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Adresse</label>
                <input type="text" class="form-control" id="address" name="address"
                       value="{{ $company->address }}">
                @error('address')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">Ville</label>
                <input type="text" class="form-control" id="city" name="city" value="{{ $company->city }}">
                @error('city')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="postal_code" class="form-label">Code postal</label>
                <input type="text" class="form-control" id="postal_code" name="postal_code"
                       value="{{ $company->postal_code }}">
                @error('postal_code')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="company_phone" class="form-label">Numéro de téléphone</label>
                <input type="text" class="form-control" id="company_phone" name="company_phone" value="{{ $company->company_phone }}"
                       aria-describedby="phoneHelp">
                <div id="phoneHelp" class="form-text">Avec ou sans indicatif</div>
                @error('company_phone')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="company_email" class="form-label">Email</label>
                <input type="email" class="form-control" id="company_email" name="company_email" value="{{ $company->company_email }}"
                       aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Saisissez un e-mail valide</div>
                @error('company_email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="website" class="form-label">Site Internet</label>
                <input type="url" class="form-control" id="website" name="website"
                       value="{{ $company->website }}" aria-describedby="websiteHelp">
                <div id="websiteHelp" class="form-text">Saisissez une url valide</div>
                @error('website')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <p>Logo actuel</p>
                @if($company->logo)
                    <img style="width: 50px" src="{{ asset($company->logo) }}"
                         alt="Logo de l'entreprise {{$company->name}}">
                @else
                    <p class="text-danger">Aucun</p>
                @endif
                <br>
                <label for="logo" class="form-label">Changer de logo</label>
                <input type="file" class="form-control" id="logo" name="logo" aria-describedby="logoHelp">
                <div id="logoHelp" class="form-text">Seul les fichiers PNG,JPG,JPEG et WEBP sont autorisés</div>
                @error('logo')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <p>Bannière actuelle</p>
                @if($company->banner)
                    <img style="height: 100px" src="{{ asset($company->banner) }}"
                         alt="Bannière de l'entreprise {{$company->name}}">
                @else
                    <p class="text-danger">Aucun</p>
                @endif
                <br>
                <label for="banner" class="form-label">Changer de bannière</label>
                <input type="file" class="form-control" id="banner" name="banner" aria-describedby="bannerHelp">
                <div id="bannerHelp" class="form-text">Seul les fichiers PNG, JPG, JPEG et WEBP sont autorisés
                </div>
                @error('banner')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="active" class="form-label">Statut</label>
                <select class="form-select" id="active" name="active">
                    <option value="1" @if($company->active) selected @endif>Actif</option>
                    <option value="0" @if(!$company->active) selected @endif>Inactif</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
@endsection
