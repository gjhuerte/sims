<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Supplies Inventory Management System') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
          {{--           <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button> --}}

                    <!-- Branding Image -->
                    <a class="" href="{{ url('/') }}" style="margin: 10px;">
                        <div style="color: #800000;margin:0;padding:0;">
                            <div class="col-lg-4">
                                <img src="{{ asset('images/logo.png') }}" style="height: 64px;width:auto;" />
                            </div>
                            <div class="col-lg-8" style="font-size: 12px;white-space:nowrap;margin:0px;padding:0px;">
                                <div class="row">
                                    <h5><strong>Polytechnic University Of the Philippines</strong></h5>
                                </div>
                                <div class="row">
                                {{ config('app.name', 'Supplies Inventory Management System') }}
                                </div>
                            </div>  
                        </div>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
