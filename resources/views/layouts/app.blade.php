<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | MonOffreD'emploi.fr</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid container">
            <a class="navbar-brand" href="{{route('home')}}">MonOffreD'emploi.fr</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('home')}}">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('companies')}}">Entreprises</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('offers')}}">Offres d'emploi</a>
                    </li>
                </ul>
                <form class="d-flex" role="search" action="{{ route('offers.search') }}" method="get">
                    <input class="form-control me-2" type="search" name="query" placeholder="Rechercher" aria-label="Rechercher">
                    <button class="btn btn-outline-success" type="submit">Rechercher</button>
                </form>
                @if(\Illuminate\Support\Facades\Auth::user())
                    <a class="btn btn-danger" href="{{route('auth.logout')}}">Déconnexion</a>
                @else
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('auth.login')}}">Connexion</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                Inscription
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{route('auth.register.user')}}">Candidat</a></li>
                                <li><a class="dropdown-item" href="{{route('auth.register.company')}}">Entreprise</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
    </nav>
</header>
@yield('content')
<footer>
    <div class="container">
        <hr>
        <p><strong>MonOffreD'emploi.fr</strong></p>
        <p>© 2024 - Tous droits réservés</p>
    </div>
</footer>
</body>
</html>
