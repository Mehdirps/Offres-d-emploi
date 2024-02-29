<div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            @if(!\Illuminate\Support\Facades\Auth::user() || \Illuminate\Support\Facades\Auth::user()->role === "entreprise" )
                <div class="modal-header d-flex flex-column align-items-start">
                    <h5 class="modal-title" id="applyModalLabel">Vous devez être connecté en tant que candidat pour
                        postuler à une offre</h5>
                    <a href="{{route('auth.login')}}" class="btn btn-outline-success mt-2">Se connecter</a>
                    <button type="button" class="btn-close align-self-end" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
            @elseif(!\Illuminate\Support\Facades\Auth::user()->email_verified_at)
                <div class="modal-header d-flex flex-column align-items-start">
                    <h5 class="modal-title" id="applyModalLabel">Vous devez valider votre adresse email pour postuler
                        une
                        offre, regarder dans votre boite e-mail pour retrouver le mail de validation</h5>
                    <button type="button" class="btn-close align-self-end" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
            @elseif($hasApplied)
                <div class="modal-header d-flex flex-column align-items-start">
                    <h5 class="modal-title" id="applyModalLabel">Vous avez déjà postulé à cette offre. Suivez son
                        avancement depuis votre espace</h5>
                    <button type="button" class="btn-close align-self-end" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
            @else
                <div class="modal-header">
                    <h5 class="modal-title" id="applyModalLabel">Postuler à l'offre - <strong>{{$offer->title}}
                            chez {{$company->company_name}}</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="{{route('offers.apply')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="offer_id" value="{{$offer->id}}">
                        <div class="col-md-12">
                            <label for="curriculum" class="form-label">Ajouter un cv</label>
                            <input type="file" class="form-control" id="curriculum" name="curriculum" required
                                   aria-describedby="curriculumHelp">
                            <small id="curriculumHelp" class="form-text text-muted">Seuls les fichiers pdf sont
                                autorisé.</small>
                            @error('curriculum')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="cover_letter" class="form-label">Ajouter une lettre de motivation</label>
                            <input type="file" class="form-control" id="cover_letter" name="cover_letter" required
                                   aria-describedby="cover_letterHelp">
                            <small id="cover_letterHelp" class="form-text text-muted">Seuls les fichiers pdf sont
                                autorisé.</small>
                            @error('cover_letter')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message"></textarea>
                            @error('message')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-outline-success">Postuler</button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
