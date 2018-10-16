<footer id="footer">
    <section class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="widget widget_contact">
                    <h3 class="widget_title">Exchange ?</h3>
                    <p>Un lieu d'échange convivial où toutes questions trouvera une réponse</p>
                    <p>Apprentissage de la pédagogie de l'entraide. Savoir questionner pour obtenir des réponses pertinentes</p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="widget">
                    <h3 class="widget_title">Liens utiles</h3>
                    <ul>
                        <li class="{{ Request::is('/') ? 'current_page_item' : '' }}">
                            <a href="{{ url('/') }}">Accueil</a>
                        </li>
                        <li class="{{ Request::is('questions/create') ? 'current_page_item' : '' }}">
                            @if (Auth::guest())
                                <a href="{{ url('/login') }}">Poser une question</a>
                            @else
                                <a href="{{ url('/questions/create') }}">Poser une question</a>
                            @endif
                        </li>
                        <li class="">
                            <a href="{{ route('questions.index') }}">Questions</a>
                        </li>
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                        @else
                            <li><a href="{{ url('/logout') }}">Logout</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                    <div class="widget widget_contact">
                        <h3 class="widget_title">Intéret ?</h3>
                        <p>Créer en tant que projet back office pour la fabrique de Roanne, cette outil à vocation pédagogique a pour objectif de servir de lieu d'échange entre tous simploniens de toutes promotions.</p>
                    </div>
                </div>
            </div>
        </div><!-- End row -->
    </section><!-- End container -->
</footer><!-- End footer -->
<footer id="footer-bottom">
    <section class="container">
        <div class="copyrights f_left">Copyright 2018 Une Question ? | <a href="mailto:contact@idmkr.io">By Simplon-Roanne</a></div>
        <div class="social_icons f_right">
            <ul>
                <li class="twitter"><a original-title="Twitter" class="tooltip-n" href="#"><i class="social_icon-twitter font17"></i></a></li>
                <li class="facebook"><a original-title="Facebook" class="tooltip-n" href="#"><i class="social_icon-facebook font17"></i></a></li>
                <li class="gplus"><a original-title="Google plus" class="tooltip-n" href="#"><i class="social_icon-gplus font17"></i></a></li>
            </ul>
        </div><!-- End social_icons -->
    </section><!-- End container -->
</footer><!-- End footer-bottom -->