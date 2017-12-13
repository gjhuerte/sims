@if (Auth::check())
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            {{-- <img src="https://placehold.it/160x160/00a65a/ffffff/&text={{ mb_substr(Auth::user()->name, 0, 1) }}" class="img-circle" alt="User Image"> --}}
            <img src="{{ asset('images/logo.png') }}" class="img-circle" alt="User Image" />
          </div>
          <div class="pull-left info">
            <p>{{ Auth::user()->name }}</p>
            <a href="#">
              <i class="fa fa-circle text-success"></i> 
              <span>
              {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
              @if(isset(Auth::user()->position))
              ( {{  ucfirst(Auth::user()->position) }} )
              @endif
              </span>
            </a>
          </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">Navigation</li>
          <!-- ================================================ -->
          <!-- ==== Recommended place for admin menu items ==== -->
          <!-- ================================================ -->
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>

          @if(false)

          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/elfinder') }}"><i class="fa fa-files-o"></i> <span>File manager</span></a></li>

          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/language') }}"><i class="fa fa-flag-o"></i> <span>Languages</span></a></li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/language/texts') }}"><i class="fa fa-language"></i> <span>Language Files</span></a></li>

          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/log') }}"><i class="fa fa-terminal"></i> <span>Logs</span></a></li>

          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/setting') }}"><i class="fa fa-cog"></i> <span>Settings</span></a></li>

          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/page') }}"><i class="fa fa-file-o"></i> <span>Pages</span></a></li>

          @endif

          @if( Auth::user()->access == 0 || Auth::user()->access == 1 || Auth::user()->access == 2 )

          @if(Auth::user()->access == 0)

          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/backup') }}"><i class="fa fa-hdd-o"></i> <span>Backups</span></a></li>

          @else

          <li><a href="{{ url('purchaseorder') }}"><i class="fa fa-shopping-basket" aria-hidden="true"></i> <span> Purchase Order</span></a></li>

          <li><a href="{{ url('receipt') }}"><i class="fa fa-files-o" aria-hidden="true"></i> <span> Receipt </span></a></li>

          <li><a href="{{ url('inventory/supply') }}"><i class="fa fa-list-alt" aria-hidden="true"></i> <span> Inventory </span></a></li>

          @endif

          @if(Auth::user()->access == 1)

          <li class="header">Information System</li>

          <li><a href="{{ url('maintenance/supply') }}"><i class="fa fa-database" aria-hidden="true"></i> <span> Supply</span></a></li>

          <li><a href="{{ url('maintenance/office') }}"><i class="fa fa-home" aria-hidden="true"></i> <span> Office </span></a></li>

          <li><a href="{{ url('maintenance/unit') }}"><i class="fa fa-balance-scale" aria-hidden="true"></i> <span> Unit </span></a></li>

          <li><a href="{{ url('maintenance/supplier') }}"><i class="fa fa-truck" aria-hidden="true"></i> <span> Supplier </span></a></li>

          @endif

          @if(Auth::user()->access == 2)

          <li><a href="{{ url('records/uncopied') }}"><i class="fa fa-clock-o" aria-hidden="true"></i> <span> Pending AMO Records </span></a></li>

          @endif

          @endif

          @if(Auth::user()->access == 0)
          <!-- ======================================= -->
          <li class="header">Utilities</li>

          <li><a href="{{ url('account') }}"><i class="fa fa-users" aria-hidden="true"></i> Accounts</span></a></li>

          <li><a href="{{ url('audittrail') }}"><i class="fa fa-history" aria-hidden="true"></i> <span>Audit Trail</span></a></li>
          <li><a href="{{ url('import') }}"><i class="fa fa-upload" aria-hidden="true"></i> <span>Import</span></a></li>
          @endif

          <!-- ======================================= -->
          <li class="header">{{ trans('backpack::base.user') }}</li>

          @if(Auth::user()->access != 0)
          <li><a href="{{ url('request') }}"><i class="fa fa-share" aria-hidden="true"></i> <span> Requests</span></a></li>
          @endif

          <li><a href="{{ url('settings') }}"><i class="fa fa-user-o" aria-hidden="true"></i> <span> Settings</span></a></li>

          @if(Auth::user()->access == 1 || Auth::user()->access == 2)
          <li class="header">Reports</li>

          <li><a href="{{ url('rsmi') }}"><i class="fa fa-ticket" aria-hidden="true"></i> <span> R. S. M. I. </span></a></li>
          @endif

          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/logout') }}"><i class="fa fa-sign-out"></i> <span>{{ trans('backpack::base.logout') }}</span></a></li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
@endif
