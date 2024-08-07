<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchModalLabel">Rechercher des offres</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" role="search" action="{{ route('offers.search') }}" method="get">
                    <div class="col-md-6">
                        <input class="form-control" type="search" name="query" placeholder="Poste, intitulé.." aria-label="Poste, intitulé..">
                    </div>
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="company" placeholder="Entreprise.." aria-label="Entreprise..">
                    </div>
                    <div class="col-md-6">
                        <select name="contract_type" id="contract_type" class="form-control">
                            <option disabled selected>-- Type de contrat --</option>
                            <option value="">Tous les contrats</option>
                            <option value="CDI">CDI</option>
                            <option value="CDD">CDD</option>
                            <option value="Stage">Stage</option>
                            <option value="Alternance">Alternance</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <select name="location" id="location" class="form-control">
                            <option disabled selected>-- Type de présence --</option>
                            <option value="">Tous</option>
                            <option value="Télétravail">Télétravail</option>
                            <option value="Présentiel">Présentiel</option>
                            <option value="Mixte">Mixte</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="localisation" placeholder="Lien, ville ..." aria-label="Lien, ville ...">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-outline-success">Rechercher</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
