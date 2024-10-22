<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | Panneau de contrôle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid container">
            <a class="navbar-brand" href="{{route('dashboard')}}">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('dashboard')}}">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('dashboard.company')}}">Mon entreprise</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('dashboard.offers')}}">Mes offres d'emploi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('dashboard.apply')}}">Candidatures</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('conversations.show')}}">Conversations</a>
                    </li>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <form action="{{route('auth.logout')}}">
                            @csrf
                            @method('post')
                            <input type="submit" class="btn btn-danger" value="Me déconnecter">
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
@if(\Illuminate\Support\Facades\Auth::user() && !\Illuminate\Support\Facades\Auth::user()->email_verified_at)
    <div class="alert alert-danger container"><strong>Attention !</strong> Votre adresse email n'a pas été vérifiée.
        Vous ne pourrez pas accéder à votre
        panneau de contrôle tant que vous n'aurez pas vérifié votre adresse email.
    </div>
@else
    @yield('content')
@endif
<footer>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @yield('footer_script')
    <script>
        $(document).ready(function () {
            var observer = new IntersectionObserver(function(entries, observer) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        var messageId = $(entry.target).data('id');
                        if ($(entry.target).data('user') === 'other' && $(entry.target).data('seen') == 0) {
                            $.ajax({
                                url: '/message/seen/' + messageId,
                                type: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function () {
                                    $(entry.target).css('border-color', '#dee2e6');
                                    $(entry.target).data('seen', 1);
                                }
                            });
                        }
                    }
                });
            }, {});

            $('.card.mb-3').each(function() {
                observer.observe(this);
            });
        });
    </script>
</footer>
</body>
</html>
