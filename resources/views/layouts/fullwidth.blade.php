<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>

        <title>@yield('title') - Exchange</title>

        @include('partials/head')

    </head>
    <body>


        <div id="wrap" class="grid_1200">

            {{-- Header --}}
            @include('partials/header')

            <section class="container main-content margin_t_50">
                <div class="row">
                    <div class="col-md-12">
                        @include('partials/messages')

                        @yield('content')
                    </div>
                </div>
            </section><!-- End container -->

            @include('partials/footer')
        </div><!-- End wrap -->

        <div class="go-up"><i class="icon-chevron-up"></i></div>

        <!-- js -->
        <script src="{{ asset('/js/jquery.min.js') }}"></script>
        <script src="{{ asset('/js/jquery-ui-1.10.3.custom.min.js') }}"></script>
        <script src="{{ asset('/js/jquery.easing.1.3.min.js') }}"></script>
        <script src="{{ asset('/js/html5.js') }}"></script>
        <script src="{{ asset('/js/twitter/jquery.tweet.js') }}"></script>
        <script src="{{ asset('/js/jflickrfeed.min.js') }}"></script>
        <script src="{{ asset('/js/jquery.inview.min.js') }}"></script>
        <script src="{{ asset('/js/jquery.tipsy.js') }}"></script>
        <script src="{{ asset('/js/tabs.js') }}"></script>
        <script src="{{ asset('/js/jquery.flexslider.js') }}"></script>
        <script src="{{ asset('/js/jquery.prettyPhoto.js') }}"></script>
        <script src="{{ asset('/js/jquery.carouFredSel-6.2.1-packed.js') }}"></script>
        <script src="{{ asset('/js/jquery.scrollTo.js') }}"></script>
        <script src="{{ asset('/js/jquery.nav.js') }}"></script>
        <script src="{{ asset('/js/tags.js') }}"></script>
        <script src="{{ asset('/js/jquery.bxslider.min.js') }}"></script>
        <script src="{{ asset('/js/custom.js') }}"></script>
        <!-- End js -->
	@yield('scripts')
    </body>
</html>
