<div id="header-top" class="colorBackgroundSimplon">
    <section class="container-fluid clearfix">
        <nav class="header-top-left-nav">
            <ul>
                @if($currentUser)
                    <li>Bonjour {{ $currentUser->name }}. Tu as {{ $currentUser->points }} points de karma</li>
                @else
                    <li>Hey Simplonnien.ne ! Rejoins-nous vite =></li>
                @endif
            </ul>
        </nav>
        <div class="header-top-right">
            @if($currentUser)
                <div class="dropdown">
                    <button class="btn btn-small btn-profil dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Mon profil
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route('profil.user') }}">Mes informations</a>
                        @if($currentUser->is_admin)
                            <a class="dropdown-item" href="{{ route('admin.users') }}">Administrateur</a>
                            <div class="dropdown-divider"></div>
                        @endif
                        <a class="dropdown-item" href="{{ url('/logout') }}">Déconnexion</a>
                    </div>
                </div>
            @else
                <nav class="header-top-right-nav">
                    <ul>
                        <li><a href="{{ url('/login') }}">Connexion</a></li>
                        <li><a href="{{ url('/register') }}">Inscription</a></li>
                    </ul>
                </nav>
            @endif
        </div>
    </section><!-- End container -->
</div>
<header id="header">
    <!-- navbar bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-dark ">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <span class="colorTextSimplon text-wrap">Simplon-Exchange</span>.Help
            </a><span class="badge badge-light beta">Béta</span>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/') }}">Accueil <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item {{ Request::is('questions/create') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('questions.create') }}">Poser une question</a>
                    </li>
                    <li class="nav-item {{ Request::is('questions') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('questions.index') }}">Donner une réponse</a>
                    </li>
                    <li class="nav-item last {{ Request::is('faq') ? 'active' : '' }}">
                        <a class="nav-link" href="#">Foire aux questions</a>
                    </li>
                    <div class="mobile-nav">
                        @if($currentUser)
                            <div class="dropdown-divider"></div>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('profil.user') }}">Profil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.users') }}">Administrateur</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/logout') }}">Déconnexion</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/login') }}">Connexion</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/register') }}" class="nav-link">Inscription</a>
                            </li>
                        @endif
                    </div>
                </ul>
            </div>
        </div>
    </nav>
</header><!-- End header -->
