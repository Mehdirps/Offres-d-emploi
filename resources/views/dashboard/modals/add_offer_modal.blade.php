<div class="modal fade" id="add-offer" aria-hidden="true" aria-labelledby="add-offerLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="add-offerLabel">Ajouter une offre</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('dashboard.offers.store')}}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label for="title" class="form-label">Titre de l'offre</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
                        @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="short_description" class="form-label">Description courte</label>
                        <textarea class="form-control" name="short_description" id="short_description" cols="10"
                                  rows="5">{{old('short_description')}}</textarea>
                        @error('short_description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description longue</label>
                        <textarea class="form-control" name="description" id="description" cols="10"
                                  rows="10">{{old('description')}}</textarea>
                        @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="contract_type" class="form-label">Type de contrat</label>
                            <select class="form-control" name="contract_type" id="contract_type">
                                <option disabled selected>-- Choisissez un type --</option>
                                <option value="CDI">CDI</option>
                                <option value="CDD">CDD</option>
                                <option value="Stage">Stage</option>
                                <option value="Alternance">Alternance</option>
                                <option value="Freelance">Freelance</option>
                            </select>
                            @error('contract_type')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="annual_salary_minumun" class="form-label">Salaire minimum</label>
                            <input type="number" class="form-control" id="annual_salary_minumun"
                                   name="annual_salary_minumun" value="{{old('annual_salary_minumun')}}">
                            @error('annual_salary_minumun')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="annual_salary_maximun" class="form-label">Salaire maximum</label>
                            <input type="number" class="form-control" id="annual_salary_maximun"
                                   name="annual_salary_maximun" value="{{old('annual_salary_maximun')}}">
                            @error('annual_salary_maximun')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="advantages" class="form-label">Avantages</label>
                        <textarea class="form-control" name="advantages" id="advantages" cols="10" rows="5">{{old('advantages')}}</textarea>
                        @error('advantages')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">Localisation</label>
                        <input type="text" class="form-control" id="city" name="city" value="{{old('city')}}">
                        @error('city')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Type de présence (télétravail/présentiel)</label>
                        <select class="form-control" name="location" id="location">
                            <option disabled selected>-- Choisissez un type --</option>
                            <option value="Télétravail">Télétravail</option>
                            <option value="Présentiel">Présentiel</option>
                            <option value="Mixte">Mixte</option>
                        </select>
                        @error('location')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="experience" class="form-label">Experience</label>
                        <textarea class="form-control" name="experience" id="experience" cols="10" rows="5">{{old('experience')}}</textarea>
                        @error('experience')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="languages_required" class="form-label">Langues</label>
                        <textarea class="form-control" name="languages_required" id="languages_required" cols="10" rows="5">{{old('languages_required')}}</textarea>
                        @error('languages_required')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>
