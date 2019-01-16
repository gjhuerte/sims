<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>
      {{ isset($title) ? $title.' :: '.config('app.name') : config('app.name') }}
    </title>

    <!-- Bootstrap -->
    {{ HTML::style(asset('css/jquery-ui.css')) }}
    {{ HTML::style(asset('css/bootstrap.min.css')) }}
    {{ HTML::style(asset('css/sweetalert.css')) }}
    {{ HTML::style(asset('css/dataTables.bootstrap.min.css')) }}
    <link rel="stylesheet" href="{{ asset('vendor/backpack/pnotify/pnotify.custom.min.css') }}">

    @yield('styles-include')
  </head>
  <body>

    @yield('navbar')
    @yield('content')

    {{-- <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script> --}}
    {{-- <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script> --}}


    {{ HTML::script(asset('js/jquery.min.js')) }}
    {{ HTML::script(asset('js/jquery-ui.js')) }}

    {{ HTML::script(asset('js/bootstrap.min.js')) }}
    {{ HTML::script(asset('js/sweetalert.min.js')) }}
    {{ HTML::script(asset('js/jquery.dataTables.min.js')) }}
    {{ HTML::script(asset('js/dataTables.bootstrap.min.js')) }}
    <script src="{{ asset('js/script.js') }}"></script>

    <script src="{{ asset('vendor/backpack/pnotify/pnotify.custom.min.js') }}"></script>

    {{-- Bootstrap Notifications using Prologue Alerts --}}
    <script type="text/javascript">
      jQuery(document).ready(function($) {

        PNotify.prototype.options.styling = "bootstrap3";
        PNotify.prototype.options.styling = "fontawesome";

        @foreach (Alert::getMessages() as $type => $messages)
            @foreach ($messages as $message)

                $(function(){
                  new PNotify({
                    // title: 'Regular Notice',
                    text: "{{ $message }}",
                    type: "{{ $type }}",
                    icon: false
                  });
                });

            @endforeach
        @endforeach
      });
    </script>

    @yield('scripts-include')
  </body>
</html>
