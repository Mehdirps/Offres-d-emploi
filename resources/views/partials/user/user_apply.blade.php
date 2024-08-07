<div id="apply-section">
    @if(count($apply) >0)
        <h2>Mes candidatures</h2>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Entreprise</th>
                    <th>Offre</th>
                    <th>Contrat</th>
                    <th>Présence</th>
                    <th>Localisation</th>
                    <th>Postulé le</th>
                    <th>Status</th>
                    <th>Etat</th>
                </tr>
                </thead>
                <tbody>
                @foreach($apply as $item)
                    <tr>
                        <td>
                            <img width="50px" src="{{ asset($item->company->logo) }}"
                                 alt="Logo de {{ $item->company->company_name }}"
                                 class="img-thumbnail">
                        </td>
                        <td>
                            @if($item->offer->active)
                                <a href="{{route('company.offers', [$item->offer->slug,$item->offer->id])}}">{{$item->offer->title}}</a>
                            @else
                                {{$item->offer->title}}
                            @endif
                        </td>
                        <td>{{$item->offer->contract_type}}</td>
                        <td>{{$item->offer->location}}</td>
                        <td>{{$item->offer->city}}</td>
                        <td>{{$item->created_at->format('d/m/Y')}}</td>
                        <td>
                            @if($item->status == 'pending')
                                <span class="badge bg-warning">En attente</span>
                            @elseif($item->status == 'accepted')
                                <span class="badge bg-success">Accepté</span>
                            @else
                                <span class="badge bg-danger">Refusé</span>
                        @endif
                        </td>
                        <td>
                            @if($item->offer->active)
                                <span class="badge bg-success">Actif</span>
                            @else
                                <span class="badge bg-danger">Inactif</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @else
                <p class="alert alert-info">Aucune candidature pour le moment, <a href="{{route('offers')}}">trouver
                        l'offre
                        faite pour vous içi</a>
                </p>
            @endif
        </div>
</div>
