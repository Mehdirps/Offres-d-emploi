<div class="modal fade" id="update-offer" aria-hidden="true" aria-labelledby="update-offerLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="update-offerLabel">Modifier une offre</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('dashboard.offers.update', $offer->id)}}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label for="title" class="form-label">Titre de l'offre</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{$offer->title}}">
                        @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="short_description" class="form-label">Description courte</label>
                        <textarea class="form-control" name="short_description" id="short_description" cols="10"
                                  rows="5">{{$offer->short_description}}</textarea>
                        @error('short_description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description longue</label>
                        <textarea class="form-control" name="description" id="description" cols="10"
                                  rows="10">{{$offer->description}}</textarea>
                        @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="contract_type" class="form-label">Type de contrat</label>
                            <select class="form-control" name="contract_type" id="contract_type">
                                <option disabled>-- Choisissez un type --</option>
                                <option value="CDI" {{$offer->contract_type == 'CDI' ? 'selected' : ''}}>CDI</option>
                                <option value="CDD" {{$offer->contract_type == 'CDD' ? 'selected' : ''}}>CDD</option>
                                <option value="Stage" {{$offer->contract_type == 'Stage' ? 'selected' : ''}}>Stage</option>
                                <option value="Alternance" {{$offer->contract_type == 'Alternance' ? 'selected' : ''}}>Alternance</option>
                                <option value="Freelance" {{$offer->contract_type == 'Freelance' ? 'selected' : ''}}>Freelance</option>
                            </select>
                            @error('contract_type')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="annual_salary_minumun" class="form-label">Salaire minimum</label>
                            <input type="text" class="form-control" id="annual_salary_minumun"
                                   name="annual_salary_minumun" value="{{$offer->annual_salary_minumun}}">
                            @error('annual_salary_minumun')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="annual_salary_maximun" class="form-label">Salaire maximum</label>
                            <input type="text" class="form-control" id="annual_salary_maximun"
                                   name="annual_salary_maximun" value="{{$offer->annual_salary_maximun}}">
                            @error('annual_salary_maximun')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="advantages" class="form-label">Avantages</label>
                        <textarea class="form-control" name="advantages" id="advantages" cols="10" rows="5">{{$offer->advantages}}</textarea>
                        @error('advantages')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">Localisation</label>
                        <input type="text" class="form-control" id="city" name="city" value="{{$offer->city}}">
                        @error('city')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Type de présence (télétravail/présentiel)</label>
                        <select class="form-control" name="location" id="location">
                            <option disabled>-- Choisissez un type --</option>
                            <option value="Télétravail" {{$offer->location == 'Télétravail' ? 'selected' : ''}}>Télétravail</option>
                            <option value="Présentiel" {{$offer->location == 'Présentiel' ? 'selected' : ''}}>Présentiel</option>
                            <option value="Mixte" {{$offer->location == 'Mixte' ? 'selected' : ''}}>Mixte</option>
                        </select>
                        @error('location')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="experience" class="form-label">Experience</label>
                        <textarea class="form-control" name="experience" id="experience" cols="10" rows="5">{{$offer->experience}}</textarea>
                        @error('experience')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="languages_required" class="form-label">Langues</label>
                        <textarea class="form-control" name="languages_required" id="languages_required" cols="10" rows="5">{{$offer->languages_required}}</textarea>
                        @error('languages_required')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <p>Actif Non/Oui</p>
                        <input type="checkbox" class="checkbox" id="active{{ $offer->id }}" name="active"
                            {{ $offer->active ? 'checked=checked' : '' }}>
                        <label for="active{{ $offer->id }}"></label>
                        @error('active')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    input[type="checkbox"].checkbox {
        display: none;
    }

    input[type="checkbox"].checkbox+label {
        box-sizing: border-box;
        display: inline-block;
        width: 3rem;
        height: 1.5rem;
        border-radius: 1.5rem;
        padding: 2px;
        background-color: #cccccc;
        transition: all 0.5s;
    }

    input[type="checkbox"].checkbox+label::before {
        box-sizing: border-box;
        display: block;
        content: "";
        height: calc(1.5rem - 4px);
        width: calc(1.5rem - 4px);
        border-radius: 50%;
        background-color: #fff;
        transition: all 0.5s;
    }

    input[type="checkbox"].checkbox:checked+label {
        background-color: #5d5d5d;
    }

    input[type="checkbox"].checkbox:checked+label::before {
        margin-left: 1.5rem;
    }
</style>
