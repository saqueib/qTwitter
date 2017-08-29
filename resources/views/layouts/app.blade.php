<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar ">
            <div class="container">
                <div class="navbar-brand">
                    <a class="navbar-item" href="{{ url('/') }}">
                        <img src="{{ asset('img/qTwitter-logo.png') }}" alt="{{ config('app.name', 'Laravel') }}" height="38">
                    </a>

                    <div class="navbar-burger burger" data-target="navMenubd-example">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>

                <div id="navMenubd-example" class="navbar-menu">
                    <div class="navbar-start">

                    </div>

                    <div class="navbar-end">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <div class="navbar-item">
                                <a class="button is-primary" href="{{ route('login') }}">
                                      <span class="icon">
                                        <i class="fa fa-sign-in"></i>
                                      </span>
                                    <span>Login</span>
                                </a>
                            </div>
                        @else
                            <a class="navbar-item" href="#">
                              <span class="icon has-text-grey-light">
                                <i class="fa fa-bell-o"></i>
                              </span>
                            </a>

                            <div class="navbar-item has-dropdown is-hoverable">
                                <a class="navbar-link  is-active" href="/documentation/overview/start/">
                                    <img src="{{ auth()->user()->avatar }}" class="is-circle" alt="">
                                </a>
                                <div class="navbar-dropdown is-boxed is-right">
                                    <div class="navbar-item">
                                        <strong>
                                            {{ auth()->user()->name }}
                                        </strong>
                                    </div>
                                    <a class="navbar-item " href="/t">
                                        Profile
                                    </a>
                                    <hr class="navbar-divider">
                                    <a class="navbar-item " href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Get all "navbar-burger" elements
            var $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

            // Check if there are any nav burgers
            if ($navbarBurgers.length > 0) {

                // Add a click event on each of them
                $navbarBurgers.forEach(function ($el) {
                    $el.addEventListener('click', function () {

                        // Get the target from the "data-target" attribute
                        var target = $el.dataset.target;
                        var $target = document.getElementById(target);

                        // Toggle the class on both the "navbar-burger" and the "navbar-menu"
                        $el.classList.toggle('is-active');
                        $target.classList.toggle('is-active');

                    });
                });
            }

        });
    </script>
</body>
</html>
