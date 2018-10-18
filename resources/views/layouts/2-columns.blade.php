<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>

        <title>@yield('title') - Exchange</title>

        @include('partials/head')

    </head>
    <body>

        <div class="loader"><div class="loader_html"></div></div>

        <div id="wrap" class="grid_1200">

            {{-- Header --}}
            @include('partials/header')

            {{-- Search form section --}}
            @yield('search-form')

            <section class="container main-content margin_t_50">
                <div class="row">
                    <div class="col-md-9">
                        @include('partials/messages')

                        @yield('content')
                    </div>
                    {{-- Sidebar --}}
                    <aside class="col-md-3 sidebar">
                        @section('sidebar')
                            @include('partials/sidebar')
                        @show
                    </aside>
                </div>
            </section><!-- End container -->

            @include('partials/footer')
        </div><!-- End wrap -->

        <div class="go-up"><i class="icon-chevron-up"></i></div>

        <!-- js -->
        <script src="{{ asset('public/js/jquery.min.js') }}"></script>
        <script src="{{ asset('public/js/jquery-ui-1.10.3.custom.min.js') }}"></script>
        <script src="{{ asset('public/js/jquery.easing.1.3.min.js') }}"></script>
        <script src="{{ asset('public/js/html5.js') }}"></script>
        <script src="{{ asset('public/js/twitter/jquery.tweet.js') }}"></script>
        <script src="{{ asset('public/js/jflickrfeed.min.js') }}"></script>
        <script src="{{ asset('public/js/jquery.inview.min.js') }}"></script>
        <script src="{{ asset('public/js/jquery.tipsy.js') }}"></script>
        <script src="{{ asset('public/js/tabs.js') }}"></script>
        <script src="{{ asset('public/js/jquery.flexslider.js') }}"></script>
        <script src="{{ asset('public/js/jquery.prettyPhoto.js') }}"></script>
        <script src="{{ asset('public/js/jquery.carouFredSel-6.2.1-packed.js') }}"></script>
        <script src="{{ asset('public/js/jquery.scrollTo.js') }}"></script>
        <script src="{{ asset('public/js/jquery.nav.js') }}"></script>
        <script src="{{ asset('public/js/tags.js') }}"></script>
        <script src="{{ asset('public/js/jquery.bxslider.min.js') }}"></script>
        <script src="{{ asset('public/js/custom.js') }}"></script>
        <!-- End js -->

        @yield('scripts')

    </body>
</html>
