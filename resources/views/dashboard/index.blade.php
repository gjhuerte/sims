@extends('backpack::layout')

@section('header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>SIMS</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
@endsection

@section('content')<!-- Content Wrapper. Contains page content -->
  <!-- Info boxes -->
  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Purchase Order</span>
          <span class="info-box-number">{{ isset($purchaseorder_count) ? $purchaseorder_count : 0 }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Receipt</span>
          <span class="info-box-number">{{ isset($receipt_count) ? $receipt_count : 0 }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Inventory</span>
          <span class="info-box-number">{{ isset($supply_count) ? $supply_count : 0 }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Requests</span>
          <span class="info-box-number">{{ isset($ris_count) ? $ris_count : 0 }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Monthly Supply Release Report</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <div class="btn-group">
              <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-wrench"></i></button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </div>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <p class="text-center">
                <strong>Issued Inventory: {{ Carbon\Carbon::now()->startOfYear()->toFormattedDateString() }} {{ Carbon\Carbon::now()->endOfMonth()->toFormattedDateString() }} </strong>
              </p>

              <div class="chart">
                <!-- Sales Chart Canvas -->
                <canvas id="myChart" style="height: 180px;"></canvas>
              </div>
              <!-- /.chart-responsive -->
            </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- ./box-body -->
        <div class="box-footer">
          <div class="row">
            <div class="col-sm-4 col-xs-4">
              <div class="description-block border-right">
                <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> {{ $most_request->total }}</span>
                <h5 class="description-header">{{ $most_request->stocknumber }} </h5>
                <span class="description-text">Most Requested Item  </span>
              </div>
              <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-4 col-xs-4">
              <div class="description-block border-right">
                <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> {{ $request_office->total }}</span>
                <h5 class="description-header">{{ $request_office->organization }}</h5>
                <span class="description-text">Most Request Office</span>
              </div>
              <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-4 col-xs-4">
              <div class="description-block border-right">
                <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> </span>
                <h5 class="description-header">{{ $total }}</h5>
                <span class="description-text">Total Items Released</span>
              </div>
              <!-- /.description-block -->
            </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-footer -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- Main row -->
  <div class="row">
    <!-- Left col -->
    <div class="col-md-8">

      <!-- TABLE: LATEST ORDERS -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Latest Orders</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table class="table no-margin">
              <thead>
              <tr>
                <th>Receipt</th>
                <th>Item</th>
                <th>Organization</th>
                <th>Quantity</th>
              </tr>
              </thead>
              <tbody>
              @foreach($received as $received)
              <tr>
                <td>{{ $received->receipt }}</td>
                <td>{{ $received->stocknumber }}</td>
                <td>{{ $received->organization }}</td>
                <td>{{ $received->received }}</td>
              </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <a href="{{ url('inventory/supply/stockcard/batch/form/accept') }}" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
          <a href="{{ url('inventory/supply') }}" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
        </div>
        <!-- /.box-footer -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->

    <div class="col-md-4">

      <!-- PRODUCT LIST -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Recently Added Products</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <ul class="products-list product-list-in-box">
          @if( count($recent_supplies) > 0 )
            @foreach( $recent_supplies as $recent )
            <!-- /.item -->
            <li class="item">
              <div class="product-img">
                <img data-name="{{ $recent->supply->details }}" class="media-object profile-image" alt="Profile Image"> 
              </div>
              <div class="product-info">
                <a href="javascript:void(0)" class="product-title">{{ $recent->supply->stocknumber }}
                  <span class="label label-success pull-right">{{ $recent->received }}</span></a>
                <span class="product-description">
                      {{ $recent->supply->details }}
                    </span>
              </div>
            </li>
            @endforeach
          @endif
            <!-- /.item -->
          </ul>
        </div>
        <!-- /.box-body -->
        <div class="box-footer text-center">
          <a href="{{ url('inventory/supply') }}" class="uppercase">View All Products</a>
        </div>
        <!-- /.box-footer -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

@endsection

@section('after_scripts') 
<script src="{{ asset('js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('js/Chart.min.js') }}"></script>
<script> 
  $(document).ready(function(){ 
     $('.profile-image').initial();

    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
              @foreach($released_count as $released)
              moment('{{ $released->month }}','M YYYY').format('MMMM'),
              @endforeach
            ],
            datasets: [{
                label: '# of Released Items',
                data: [
                  @foreach($released_count as $released)
                  {{ $released->issued . "," }}
                  @endforeach
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });  
  }) 
</script> 
@endsection 
