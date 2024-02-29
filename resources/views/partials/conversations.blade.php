<div class="row">
    <div class="col-md-4">
        <h2>Listes des conversations</h2>
        @if(count($conversations) > 0)
            @foreach($conversations as $conversation)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Conversation #{{ $conversation->id }}</h5>
                        <p class="card-text">Pour l'offre {{ $conversation->offer->title }}</p>
                        <p class="card-text">Avec  <strong>{{ $conversation->user->name }}</strong></p>
                        <a href="#conversation-{{ $conversation->id }}" class="stretched-link" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="conversation-{{ $conversation->id }}"></a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-info">Aucune conversation pour le moment</div>
        @endif
    </div>
    <div class="col-md-8">
        <h2>Messages</h2>
        @if(count($conversations) > 0)
            @foreach($conversations as $conversation)
                <div class="collapse" id="conversation-{{ $conversation->id }}">
                    <h3>Candidat : <strong>{{ $conversation->user->name }}</strong></h3>
                    <h4>{{ $conversation->offer->title }}</h4>
                    <div class="message-container" style="max-height: 500px; overflow-y: auto;">
                        @if(count($conversation->messages) > 0)
                            @foreach($conversation->messages as $message)
                                <div class="card mb-3">
                                    <div class="card-body" style="{{ $message->user_id == auth()->id() ? 'text-align:right' : '' }}">
                                        <h5 class="card-title">{{ $message->user_id == auth()->id() ? 'Moi' : $message->user->name }} </h5>
                                        <p class="card-text">{{ $message->message }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-info">Aucun message pour l'instant</div>
                        @endif
                    </div>
                    <form action="{{route('conversation.message.create')}}" method="post">
                        @csrf
                        <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="message" placeholder="Écrivez votre message ici...">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Envoyer</button>
                            </div>
                        </div>
                    </form>
                </div>
            @endforeach
        @endif
    </div>
</div>
