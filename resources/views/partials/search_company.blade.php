<div class="modal fade" id="searchCompanyModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchModalLabel">Rechercher des offres</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" role="search" action="{{ route('companies.search') }}" method="get">
                    <div class="col-auto">
                        <label for="search" class="visually-hidden">Recherche</label>
                        <input type="text" class="form-control" id="search" name="search" placeholder="Nom de l'entreprise, code postal ou ville">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">Rechercher</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
