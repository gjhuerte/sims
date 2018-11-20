<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/bootstrap/css/bootstrap.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
      function subst() {
        var vars={};
        var x=document.location.search.substring(1).split('&');
        for (var i in x) {var z=x[i].split('=',2);vars[z[0]] = unescape(z[1]);}
        var x=['frompage','topage','page','webpage','section','subsection','subsubsection'];
        for (var i in x) {
          var y = document.getElementsByClassName(x[i]);
          for (var j=0; j<y.length; ++j) y[j].textContent = vars[x[i]];
        }
      }
    </script>
  </head>
  <body>
    <div id="header">
        <div class="col-sm-12 text-center">
          <tr>
            <td class="section"></td>
            <td style="text-align:right">
              Page <span class="page"></span> of <span class="topage"></span>
            </td>
          </tr>
        </div>
    </div>
  </body>
</html>