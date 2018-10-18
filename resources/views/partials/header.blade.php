<div id="header-top">
    <section class="container clearfix">
        <nav class="header-top-nav">
            <ul>
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}"><i class="icon-user"></i>Login Area</a></li>
                @else
                    <li><a href="{{ url('/logout') }}">Logout</a></li>
                @endif
            </ul>
        </nav>
        <div class="header-search">
            <form>
                <input type="text" value="Search here ..." onfocus="if(this.value=='Search here ...')this.value='';" onblur="if(this.value=='')this.value='Search here ...';">
                <button type="submit" class="search-submit"></button>
            </form>
        </div>
    </section><!-- End container -->
</div><!-- End header-top -->
<header id="header">
    <section class="container clearfix">
        <div class="logo">
            <a href="{{ url('/') }}" class="font26">
                <span>Exchange</span>.Simplon
            </a>
        </div>
        <nav class="navigation">
            <ul>
                <li class="{{ Request::is('/') ? 'current_page_item' : '' }}">
                    <a href="{{ url('/') }}">Accueil</a>
                </li>
                <li class="{{ Request::is('questions/create') ? 'current_page_item' : '' }}">
                        <a href="{{ url('/login') }}">Poser une question</a>
                </li>
                <li class="{{ Request::is('questions') ? 'current_page_item' : '' }}">
                    <a href="{{ route('questions.index') }}">Donner une réponse</a>
                </li>
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Connexion</a></li>
                @else
                    <li class="{{ Request::is('questions/user') ? 'current_page_item' : '' }}">
                        <a href="{{ route('questions.user') }}">Mes questions</a>
                    </li>
                    <li><a href="{{ url('/logout') }}">Déconnexion</a></li>
                @endif
            </ul>
        </nav>
	@if($currentUser)
        <div style="color: #fff;font-size: 10px;position: absolute;right: 5px;bottom: 0;">Vous avez {{ $currentUser->points }} points de karma</div>
	@endif    
</section><!-- End container -->
</header><!-- End header -->
