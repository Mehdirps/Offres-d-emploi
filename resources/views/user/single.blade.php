@extends('layouts.app')
@section('title', 'Mon espace')
@section('content')
    <div class="container">
        <h1>Bonjour {{$user->name}}, retrouver ici toutes les informations relatives à vos candidatures</h1>
        <div class="row">
            {{-- Fait deux bouton centré--}}
            <div class="col-md-6">
                <p class="btn btn-secondary" id="show-apply">Mes candidatures</p>
                <p class="btn btn-secondary" id="show-favorites">Mes offres favorites</p>
                <p class="btn btn-secondary" id="show-conversations">Mes conversations</p>
            </div>
            @include('partials.user.user_apply')
            @include('partials.user.user_favorite_apply')
            <div id="conversations" style="display: none;">
                @include('partials.conversations')
            </div>
        </div>
    </div>
@endsection
@section('footer_script_app')
    <script>
        $(document).ready(function () {
            $('#show-apply').click(function (e) {
                e.preventDefault();
                $('#conversations').hide();
                $('#favorites-section').hide();
                $('#apply-section').show();
            });

            $('#show-favorites').click(function (e) {
                e.preventDefault();
                $('#apply-section').hide();
                $('#conversations').hide();
                $('#favorites-section').show();
            });

            $('#show-conversations').click(function (e) {
                e.preventDefault();
                $('#apply-section').hide();
                $('#favorites-section').hide();
                $('#conversations').show();

            });
        });
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.collapse').on('show.bs.collapse', function () {
                $('.collapse.show').collapse('hide');
            });

        });
        $(document).ready(function () {
            var conversationId = new URL(window.location.href).searchParams.get('conv_id');
            if (conversationId) {
                $('#apply-section').hide();
                $('#favorites-section').hide();
                $('#conversations').show();
                $('#conversation-' + conversationId).collapse('show');
            }
        });
    </script>
@endsection

