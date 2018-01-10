<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>@yield('title')</title>

    <!-- Bootstrap -->
    {{ HTML::style(asset('css/jquery-ui.css')) }}
    {{ HTML::style(asset('css/bootstrap.min.css')) }}
    {{ HTML::style(asset('css/sweetalert.css')) }}
    {{ HTML::style(asset('css/dataTables.bootstrap.min.css')) }}
    @yield('style-include')
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('style')

    <style>
      /*body style*/
      body
      {
        background-color: #F5F8FA;
      }
    </style>

    {{ HTML::script(asset('js/jquery.min.js')) }}
    {{ HTML::script(asset('js/jquery-ui.js')) }}
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    {{ HTML::script(asset('js/bootstrap.min.js')) }}
    {{ HTML::script(asset('js/sweetalert.min.js')) }}
    {{ HTML::script(asset('js/jquery.dataTables.min.js')) }}
    {{ HTML::script(asset('js/dataTables.bootstrap.min.js')) }}
    <script src="{{ asset('js/script.js') }}"></script>
    @yield('script-include')
  </head>
  <body>
    @yield('navbar')
    @yield('content')
    @yield('script')
  </body>
</html>
