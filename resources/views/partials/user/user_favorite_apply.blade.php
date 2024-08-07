<div id="favorites-section" style="display: none;">
    @if(count($apply) >0)
        <h2>Mes offres favorites</h2>
        <p>Si une offre que vous avez enregistrée n'apparait pas, c'est qu'elle a été désactivé et n'est donc plus
            consultable</p>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Entreprise</th>
                    <th>Offre</th>
                    <th>Contrat</th>
                    <th>Présence</th>
                    <th>Localisation</th>
                </tr>
                </thead>
                <tbody>
                @foreach(\Illuminate\Support\Facades\Auth::user()->favoriteOffers as $item)
                    @if($item->active)
                        <tr>
                            <td>
                                <img width="50px" src="{{ asset($item->company->logo) }}"
                                     alt="Logo de {{ $item->company->company_name }}"
                                     class="img-thumbnail">
                            </td>
                            <td>
                                <a href="{{route('company.offers', [$item->slug,$item->id])}}">{{$item->title}}</a>
                            </td>
                            <td>{{$item->contract_type}}</td>
                            <td>{{$item->location}}</td>
                            <td>{{$item->city}}</td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
            @else
                <p class="alert alert-info">Aucune offre favorite pour le moment pour le moment, <a
                        href="{{route('offers')}}">trouver
                        l'offre
                        faite pour vous içi</a>
                </p>
            @endif
        </div>
</div>
