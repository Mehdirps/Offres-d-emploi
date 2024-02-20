<div class="modal fade" id="edit-company" aria-hidden="true" aria-labelledby="edit-companyLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="edit-companyLabel">Modification d'information</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('dashboard.company.update', $company) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom de l'entreprise</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $company->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="activity" class="form-label">Domaine</label>
                        <input type="text" class="form-control" id="activity" name="activity" value="{{ $company->activity }}">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description">{{ $company->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Adresse</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ $company->address }}">
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">Ville</label>
                        <input type="text" class="form-control" id="city" name="city" value="{{ $company->city }}">
                    </div>
                    <div class="mb-3">
                        <label for="postal_code" class="form-label">Code postal</label>
                        <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ $company->postal_code }}">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Numéro de téléphone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $company->phone }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $company->email }}">
                    </div>
                    <div class="mb-3">
                        <label for="website" class="form-label">Site Internet</label>
                        <input type="url" class="form-control" id="website" name="website" value="{{ $company->website }}">
                    </div>
                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo</label>
                        <input type="file" class="form-control" id="logo" name="logo">
                    </div>
                    <div class="mb-3">
                        <label for="banner" class="form-label">Bannière</label>
                        <input type="file" class="form-control" id="banner" name="banner">
                    </div>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </form>
            </div>
        </div>
    </div>
</div>
