<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>@yield('title') - Exchange</title>

        @include('partials/head')
    </head>
    <body>
        {{-- Header --}}
        @include('partials/header')

        {{-- Search form section --}}
        @yield('search-form')

        <section class="container-fluid mt-5">
            <div class="row">
                <div class="col-md-9">
                    @include('partials/messages')

                    @yield('content')
                </div>
                {{-- Sidebar --}}
                <aside class="col-md-3">
                    @section('sidebar')
                        @include('partials/sidebar')
                    @show
                </aside>
            </div>
        </section><!-- End container -->

        <span class="chevron-back-top" id="chevron" onclick="goUp()">
            <i class="fas fa-chevron-up"></i>
        </span>

        @include('partials/footer')

        @include('partials/firebase-js')

        <!-- js -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script>

            let chevronTop = document.getElementById("chevron");

            window.addEventListener('scroll', function() {
                if(window.pageYOffset > 250){
                    chevronTop.style.right = "6px";
                } else {
                    chevronTop.style.right = "-60px";
                }
            });

            function goUp() {
                window.scrollTo(1000, 0);
            }

            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })

        </script>

        @yield('scripts')

    </body>
</html>
