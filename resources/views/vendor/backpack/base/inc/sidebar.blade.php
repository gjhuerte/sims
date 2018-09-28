@if (Auth::check())
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            {{-- <img src="https://placehold.it/160x160/00a65a/ffffff/&text={{ mb_substr(Auth::user()->name, 0, 1) }}" class="img-circle" alt="User Image"> --}}
            {{-- <img src="{{ asset('images/logo.png') }}" class="img-circle" alt="User Image" /> --}}
            <img data-name="{{ Auth::user()->firstname }}" class="profile-image img-circle" alt="User Image" /> 
          </div>
          <div class="pull-left info">
            <p>{{ Auth::user()->name }}</p>
            <a href="#">
              <i class="fa fa-circle text-success"></i> 
              <span>
              {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
              @if(isset(Auth::user()->position))
              @if(strlen(Auth::user()->position) > 7)
              <br /><span class="text-center" style="font-size: 8px">
              @else
              <span class="text-center">|
              @endif
                <label> {{  substr(ucfirst(Auth::user()->position), 0, 30) . ((strlen(Auth::user()->position) > 15) ? "..." : "") }} </label>
              </span>
              @endif
              </span>
            </a>
          </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">Supplies Inventory</li>
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
          @if(Auth::user()->access == 0)

          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/backup') }}"><i class="fa fa-hdd-o"></i> <span>Backups</span></a></li>
          <li><a href="{{ url('sync') }}"><i class="fa fa-refresh"></i> <span>Sync</span></a></li>

          <li class="header">Information System</li>
          <li><a href="{{ url('maintenance/office') }}"><i class="fa fa-home" aria-hidden="true"></i> <span> Office </span></a></li>

          <li class="header">Utilities</li>
          <li><a href="{{ url('account') }}"><i class="fa fa-users" aria-hidden="true"></i> <span>Accounts</span></a></li>
          <li><a href="{{ url('audittrail') }}"><i class="fa fa-history" aria-hidden="true"></i> <span>Audit Trail</span></a></li>
          <li><a href="{{ url('import') }}"><i class="fa fa-upload" aria-hidden="true"></i> <span>Import</span></a></li>
          @endif
          
          @if(Auth::user()->access == 1)
          <li><a href="{{ url('inventory/supply') }}"><i class="fa fa-list-alt" aria-hidden="true"></i> <span> Inventory </span></a></li>
          <li><a href="{{ url('inventory/physical') }}"><i class="fa fa-archive" aria-hidden="true"></i> <span> Physical Inventory </span></a></li>
          <li><a href="{{ url('inspection') }}"><i class="fa fa-search" aria-hidden="true"></i> <span> Inspection </span></a></li>
          <li><a href="@if(Auth::user()->access == 1) {{ url('inventory/supply/stockcard/accept') }}@endif"><i class="fa fa-plus" aria-hidden="true"></i> <span> Accepts Item </span></a></li>
          <li class="treeview">
            <a href="#"><i class="fa fa-share" aria-hidden="true"></i><span>R. I. S.</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="{{ url('request') }}"><li><i class="fa fa-list" aria-hidden="true"></i>View</a></li>
                <li><a href="@if(Auth::user()->access == 1) {{ url('inventory/supply/stockcard/release') }} @endif"><li><i class="fa fa-pencil" aria-hidden="true"></i>Allocate</a></li>
              </ul>
          </li>

          <script>
            $(document).ready(function(){
              /** add active class and stay opened when selected */
              var url = window.location;

              // for sidebar menu entirely but not cover treeview
              $('ul.sidebar-menu a').filter(function() {
                 return this.href == url;
              }).parent().addClass('active');

              // for treeview
              $('ul.treeview-menu a').filter(function() {
                 return this.href == url;
              }).parentsUntil( $( "ul.level-1" ) ).addClass('active');
            })
          </script>

          <li class="treeview"><a href="#"><i class="fa fa-sliders" aria-hidden="true"></i><span>Adjustment</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="{{ url('adjustment') }}"><li><i class="fa fa-eye" aria-hidden="true"></i>View</a></li>
                <li><a href="{{ url('adjustment/dispose') }}"><li><i class="fa fa-trash-o" aria-hidden="true"></i>Disposal</a></li>
                <li><a href="{{ url('adjustment/return') }}"><li><i class="fa fa-pencil" aria-hidden="true"></i>Return</a></li>
              </ul>
          </li>
          
          <li class="header">Information System</li>
          <li><a href="{{ url('announcement') }}"><i class="fa fa-bullhorn" aria-hidden="true"></i> <span> Announcement </span></a></li>
          <li><a href="{{ url('maintenance/supply') }}"><i class="fa fa-database" aria-hidden="true"></i> <span> Supply</span></a></li>
          <li><a href="{{ url('maintenance/unit') }}"><i class="fa fa-balance-scale" aria-hidden="true"></i> <span> Unit </span></a></li>
          <li><a href="{{ url('maintenance/supplier') }}"><i class="fa fa-truck" aria-hidden="true"></i> <span> Supplier </span></a></li>

          <li class="header">Reports</li>
          <li><a href="{{ url('rsmi') }}"><i class="fa fa-ticket" aria-hidden="true"></i> <span> R. S. M. I. </span></a></li>

          <li class="header">Queries</li>
          <li><a href="{{ url('purchaseorder') }}"><i class="fa fa-shopping-bag" aria-hidden="true"></i> <span> References </span></a></li>
          <li><a href="{{ url('receipt') }}"><i class="fa fa-truck" aria-hidden="true"></i> <span> Receipts </span></a></li>
          <li><a href="{{ url('reports/rislist') }}"><i class="fa fa-list-ul" aria-hidden="true"></i> <span> RIS List </span></a></li>
          @endif
          
          @if(Auth::user()->access == 2)
          <li><a href="{{ url('inventory/supply') }}"><i class="fa fa-list-alt" aria-hidden="true"></i> <span> Inventory </span></a></li>
          <li><a href="@if(Auth::user()->access == 1) {{ url('inventory/supply/stockcard/accept') }} @elseif(Auth::user()->access == 2) {{ url('inventory/supply/ledgercard/accept') }}  @endif"><i class="fa fa-plus" aria-hidden="true"></i> <span> Accepts Item </span></a></li>

          <li class="treeview">
            <a href="#"><i class="fa fa-share" aria-hidden="true"></i><span>R. I. S.</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="@if(Auth::user()->access == 2) {{ url('inventory/supply/ledgercard/release') }}  @endif"><li><i class="fa fa-pencil" aria-hidden="true"></i>Allocate</a></li>
              </ul>
          </li>

          <script>
            $(document).ready(function(){
              /** add active class and stay opened when selected */
              var url = window.location;

              // for sidebar menu entirely but not cover treeview
              $('ul.sidebar-menu a').filter(function() {
                 return this.href == url;
              }).parent().addClass('active');

              // for treeview
              $('ul.treeview-menu a').filter(function() {
                 return this.href == url;
              }).parentsUntil( $( "ul.level-1" ) ).addClass('active');
            })
          </script>
          
          <li class="header">Information System</li>
          <li><a href="{{ url('maintenance/supply') }}">      <i class="fa fa-database" aria-hidden="true">     </i> <span> supply              </span></a></li>
          <li><a href="{{ url('maintenance/office') }}">      <i class="fa fa-home" aria-hidden="true">         </i> <span> Office              </span></a></li>
          <li><a href="{{ url('maintenance/supplier') }}">    <i class="fa fa-truck" aria-hidden="true">        </i> <span> Supplier            </span></a></li>
          <li><a href="{{ url('records/uncopied') }}">        <i class="fa fa-clock-o" aria-hidden="true">      </i> <span> Unsync Transactions </span></a></li>
          @if(false)
          <li><a href="{{ url('uacs') }}">                    <i class="fa fa-code" aria-hidden="true">         </i> <span> UACS                </span></a></li>
          <li><a href="{{ url('fundcluster') }}">             <i class="fa fa-archive" aria-hidden="true">      </i> <span> Fund Cluster        </span></a></li>
          <li><a href="{{ url('maintenance/category') }}">    <i class="fa fa-tags" aria-hidden="true">         </i> <span> Categories          </span></a></li>
          @endif

          <li class="header">Reports</li>
          <li><a href="{{ url('rsmi') }}">                    <i class="fa fa-ticket" aria-hidden="true">       </i> <span> R. S. M. I.         </span></a></li>

          <li class="header">Queries</li>
          <li><a href="{{ url('purchaseorder') }}">           <i class="fa fa-shopping-bag" aria-hidden="true"> </i> <span> References          </span></a></li>
          <li><a href="{{ url('receipt') }}">                 <i class="fa fa-truck" aria-hidden="true">        </i> <span> Receipts            </span></a></li>
          @endif
          
          @if(Auth::user()->access == 3)
          <li><a href="{{ url('request') }}">                 <i class="fa fa-share" aria-hidden="true">        </i> <span> Request             </span></a></li>
          @endif
          
          @if(Auth::user()->access == 4)
          <li><a href="{{ url('inventory/physical') }}"><i class="fa fa-archive" aria-hidden="true"></i> <span> Physical Inventory </span></a></li>
          <li><a href="{{ url('inspection') }}"><i class="fa fa-search" aria-hidden="true"></i> <span> Inspection </span></a></li>
          @endif
          
          @if(Auth::user()->access == 5)
          <li><a href="{{ url('inventory/physical') }}"><i class="fa fa-archive" aria-hidden="true"></i> <span> Physical Inventory </span></a></li>
          <li><a href="{{ url('inspection') }}"><i class="fa fa-search" aria-hidden="true"></i> <span> Inspection </span></a></li>
          @endif
          
          @if(Auth::user()->access == 6)
          <li><a href="{{ url('inventory/supply') }}"><i class="fa fa-list-alt" aria-hidden="true"></i> <span> Inventory </span></a></li>
          <li><a href="{{ url('request') }}"><i class="fa fa-share" aria-hidden="true"></i><span>R. I. S.</span></a></li>
          
          <li class="header">Information System</li>
          <li><a href="{{ url('announcement') }}"><i class="fa fa-bullhorn" aria-hidden="true"></i> <span> Announcement </span></a></li>
          <li><a href="{{ url('maintenance/supply') }}"><i class="fa fa-database" aria-hidden="true"></i> <span> Supply</span></a></li>
          @endif
          
          @if(Auth::user()->access == 7)
          <li><a href="{{ url('inventory/supply') }}"><i class="fa fa-list-alt" aria-hidden="true"></i> <span> Inventory </span></a></li>
          <li><a href="{{ url('inventory/supply/stockcard/accept') }}"><i class="fa fa-plus" aria-hidden="true"></i> <span> Accepts Item </span></a></li>
          
          <li class="header">Information System</li>
          <li><a href="{{ url('announcement') }}"><i class="fa fa-bullhorn" aria-hidden="true"></i> <span> Announcement </span></a></li>
          <li><a href="{{ url('maintenance/supply') }}"><i class="fa fa-database" aria-hidden="true"></i> <span> Supply</span></a></li>
          <li><a href="{{ url('maintenance/unit') }}"><i class="fa fa-balance-scale" aria-hidden="true"></i> <span> Unit </span></a></li>
          <li><a href="{{ url('maintenance/supplier') }}"><i class="fa fa-truck" aria-hidden="true"></i> <span> Supplier </span></a></li>
          @endif
          
          @if(Auth::user()->access == 8)
          <li><a href="{{ url('inventory/supply') }}"><i class="fa fa-list-alt" aria-hidden="true"></i> <span> Inventory </span></a></li>
          <li class="treeview"><a href="#"><i class="fa fa-sliders" aria-hidden="true"></i><span>Adjustment</span><i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="{{ url('adjustment') }}"><li><i class="fa fa-eye" aria-hidden="true"></i>View</a></li>
                <li><a href="{{ url('adjustment/dispose') }}"><li><i class="fa fa-trash-o" aria-hidden="true"></i>Disposal</a></li>
                <li><a href="{{ url('adjustment/return') }}"><li><i class="fa fa-pencil" aria-hidden="true"></i>Return</a></li>
              </ul>
          </li>
          <li class="header">Information System</li>
          <li><a href="{{ url('announcement') }}"><i class="fa fa-bullhorn" aria-hidden="true"></i> <span> Announcement </span></a></li>
          @endif
          <!-- ======================================= -->
          <li class="header">{{ trans('backpack::base.user') }}</li>
          @if(Auth::user()->access == 0)
          <li><a href="{{ url('clientfeedback') }}"><i class="fa fa-twitch" aria-hidden="true"></i><span> Comments and Suggestion</span></a></li>
          @else
          <li><a href="{{ url('clientfeedback/create') }}"><i class="fa fa-twitch" aria-hidden="true"></i><span> Comments and Suggestion</span></a></li>
          @endif
          <li><a href="{{ url('settings') }}"><i class="fa fa-user-o" aria-hidden="true"></i> <span> Settings</span></a></li>

          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/logout') }}"><i class="fa fa-sign-out"></i> <span>{{ trans('backpack::base.logout') }}</span></a></li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
@endif
