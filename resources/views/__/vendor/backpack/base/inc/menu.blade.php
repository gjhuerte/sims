<div class="navbar-custom-menu pull-left">
    <ul class="nav navbar-nav">
        <!-- =================================================== -->
        <!-- ========== Top menu items (ordered left) ========== -->
        <!-- =================================================== -->

        <!-- <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> <span>Home</span></a></li> -->

        <!-- ========== End of top menu left items ========== -->
    </ul>
</div>

<div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- ========================================================= -->
      <!-- ========== Top menu right items (ordered left) ========== -->
      <!-- ========================================================= -->

      <!-- <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> <span>Home</span></a></li> -->
        <li>
          <a href="{{ url('faqs') }}"> Frequently Asked Questions </a>
        </li>

      @if (Auth::guest())
          <li>
            <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/login') }}">{{ trans('backpack::base.login') }}</a>
          </li>
          @if (config('backpack.base.registration_open'))
          <li>
            <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/register') }}">
            {{ trans('backpack::base.register') }}
            </a>
          </li>
          @endif
      @else

      @if(Auth::user()->access == 1)
        <li data-toggle="modal" data-target="#announcementModal">
        </li>

        <li class="dropdown">
          <a id="notification-count" role="button" class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              Pending RIS  <span class="label label-danger" id="sidebar-request-count">{{ App\Request::pending()->count() }}</span> 
          </a>

          <!-- scrollbar styles -->
          <style>
            .dropdown-menu::-webkit-scrollbar-thumb
            {
              border-radius: 10px;
              -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
              background-color: #D62929;

            }
          </style>
          <!-- scrollbar styles -->

          <ul id="notification-list" class="dropdown-menu" aria-labelledby="notification-count" style="max-height: 300px;overflow-x: hidden;">
          </ul>

          <!-- navigation scrollbar -->
          <script>
            $(document).ready(function(){
              $('#notification-count').on('click', function(){

                html = `
                  <li><a href="#">Feature not yet available</a></li>
                `

                $('#notification-list').html(html)
              })
            })
          </script>
          <!-- navigation scrollbar -->

        </li>
      @endif
        <li>
          <a href="#">
          @if(isset(Auth::user()->office))
          {{ App\Office::findByCode(Auth::user()->office)->name }} 
          @endif
          </a>
        </li>
        <li>
          <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/logout') }}"><i class="fa fa-btn fa-sign-out"></i> 
            {{ trans('backpack::base.logout') }}
          </a>
        </li>
      @endif

       <!-- ========== End of top menu right items ========== -->
    </ul>
</div>
