<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>@yield('title')</title>

    {{ HTML::style(asset('css/dataTables.bootstrap.min.css')) }}
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    @yield('style-include')
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('style')

    <style>
      @page { }
      #header
    	{
    		position: fixed;
    	}

      body{
        font-family: 'Times New Roman';
      }
      .page-break { page-break-after: always; }
    </style>

    {{ HTML::script(asset('js/jquery.min.js')) }}
    @yield('script-include')
  </head>
  <body>
    <div id="header" style="position:fixed;margin-bottom:90px;">
        <div class="col-sm-12" style="color: #800000;">
            <div class="clearfix"></div>
            <div>
                <img src="{{ asset('images/logo.png') }}" class="img img-responsive img-circle pull-left" style="height: 64px;width:auto;" />
            </div>
            <div style="margin-left: 5px;">
          		<div style="font-size:10pt;">Republic of the Philippines	</div>
          		<div style="font-size:12pt;">POLYTECHNIC UNIVERSITY OF THE PHILIPPINES </div>
          		<div style="font-size:10pt;">Sta. Mesa, Manila  </div>
            </div>
        </div>
        <div class="col-sm-12">
          <hr />
        </div>
    </div>
    @yield('content')
    @yield('script')
  </body>
</html>
