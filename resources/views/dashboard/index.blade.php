@extends('backpack::layout')
  
@section('header')
<style>
    .pre-scrollable {
    max-height: 340px;
    overflow-y: scroll;
    }
   .pre-scrollable2 {
    max-height: 340px;
    overflow-y: scroll;
    overflow-x: scroll;
    }

  </style>
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

    <div class="col-md-2 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-purple"><i class="fa fa-envelope-o"></i></span>

        <div class="info-box-content">
          <span class="info-box-text" style="font-size-adjust: .45">Requests</span>
          <span class="info-box-number">{{ isset($ris_count) ? $ris_count->count : 0 }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

    <div class="col-md-2 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-hourglass-half"></i></span>

        <div class="info-box-content">
          <span class="info-box-text" style="font-size-adjust: .45">Pending Requests</span>
          <span class="info-box-number">{{ isset($ris_pending) ? $ris_pending->count : 0 }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>

    <div class="col-md-2 col-sm-6 col-xs-12" >
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-thumbs-up"></i></span>

        <div class="info-box-content">
          <span class="info-box-text" style="font-size-adjust: .45">Approved Requests</span>
          <span class="info-box-number">{{ isset($ris_approved) ? $ris_approved->count : 0 }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <div class="col-md-2 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-thumbs-down""></i></span>

        <div class="info-box-content" >
          <span class="info-box-text" style="font-size-adjust: .45">Disapproved Requests</span>
          <span class="info-box-number">{{ isset($ris_disapproved) ? $ris_disapproved->count : 0 }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <div class="col-md-2 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-ban"></i></span>

        <div class="info-box-content">
          <span class="info-box-text" style="font-size-adjust: .45">Cancelled Requests</span>
          <span class="info-box-number">{{ isset($ris_cancelled) ? $ris_cancelled->count : 0 }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-2 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-redo"></i></span>

        <div class="info-box-content">
          <span class="info-box-text" style="font-size-adjust: .45">Released Requests</span>
          <span class="info-box-number">{{ isset($ris_released) ? $ris_released->count : 0 }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    
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
            </div>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <p class="text-center">
                <strong>Issued Inventory: {{ Carbon\Carbon::now()->startOfYear()->toFormattedDateString() }} - {{ Carbon\Carbon::now()->endOfMonth()->toFormattedDateString() }} </strong>
              </p>

              <div class="chart">`
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
                <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> {{ isset($most_request->total) ? $most_request->total : "None" }}</span>
                <h5 class="description-header">{{ isset($most_request->details) ? $most_request->details : "None" }} </h5>
                <span class="description-text">Most released Item  </span>
              </div>
              <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-4 col-xs-4">
              <div class="description-block border-right">
                <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> {{ isset($request_office->total) ? $request_office->total : "None" }}</span>
                <h5 class="description-header">{{ isset($request_office->organization) ? $request_office->organization :"None" }}</h5>
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
    <div class="col-md-4">

    <!--  Supply Requests -->
      <div class="box box-info pre-scrollable">
        <div class="box-header with-border">
          <h3 class="box-title">Supply Request Ranking</h3>

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
                <th>Stock Number</th>
                <th>Item</th>
                <th>Unit</th>
                <th>Total Requests</th>
                <th>Total Quantity Requested</th>
                <th>Average Quantity per Request</th>
                <th>Highest Quantity Requested</th>
                <th>Office</th>
              </tr>
              </thead>
              <tbody>
                @foreach($most_requested_stock as $most_requested_stock)
              <tr>
                <td>{{ $most_requested_stock->stocknumber }}</td>
                <td>{{ $most_requested_stock->details }}</td>
                <td>{{ $most_requested_stock->unit }}</td>
                <td align="right">{{ $most_requested_stock->total_request }}</td>
                <td align="right">{{ $most_requested_stock->total_requested }}</td>
                <td align="right">{{ $most_requested_stock->average_item_per_request }}</td>
                <td align="right">{{ $most_requested_stock->highest_quantity_requested }}</td>
                <td align="right">{{ $most_requested_stock->name }}</td>
                <td></td>
              </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
        </div>
        <!-- /.box-footer -->
      </div>


      <!--  LATEST ORDERS -->
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
                <th>Purchase Order Number</th>
                <th>Date Received</th>
                <th>Supplier</th>
              </tr>
              </thead>
              <tbody>
              @foreach($purchaseorder as $purchaseorder)
              <tr>
                <td>{{ $purchaseorder->number }}</td>
                <td>{{ $purchaseorder->date_received }}</td>
                <td>{{ $purchaseorder->supplier->name }}</td>
              </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <a href="{{ url('inventory/supply/stockcard/accept') }}" class="btn btn-sm btn-primary pull-left">Place New Order</a>
          <a href="{{ url('inventory/supply') }}" class="btn btn-sm btn-default pull-right">View All Orders</a>
        </div>
        <!-- /.box-footer -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-4">

<!-- TABLE: office Requests -->
      <div class="box box-info pre-scrollable">
        <div class="box-header with-border">
          <h3 class="box-title">Office Request Ranking</h3>

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
                <th>Rank</th>
                <th>Office</th>
                <th>Number of Requests</th>
              </tr>
              </thead>
              <tbody>
                @foreach($office as $office)
              <tr>
                <td>{{ $office->code }}</td>
                <td>{{ $office->name }}</td>
                <td>{{ count($office->request) }}</td>
                <td></td>
              </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
        </div>
        <!-- /.box-footer -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->

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
              moment('{{ $released->date_released }}','M').format('MMMM'),
              @endforeach
            ],
            datasets: [{
                label: '# of Released Items',
                data: [
                  @foreach($released_count as $released)
                  {{ $released->count . "," }}
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
