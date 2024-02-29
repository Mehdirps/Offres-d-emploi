@extends('layouts.dashboard')
@section('title', 'Conversations')
@section('content')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @include('partials.conversations')
    </div>
@endsection
@section('footer_script')
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.collapse').on('show.bs.collapse', function () {
                $('.collapse.show').collapse('hide');
            });

        });
        $(document).ready(function () {
            var conversationId = new URL(window.location.href).searchParams.get('id');
            console.log(window.location.href)
            if (conversationId) {
                $('#conversation-' + conversationId).collapse('show');
            }
        });
    </script>
@endsection
