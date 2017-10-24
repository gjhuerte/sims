@extends('backpack::layout')

@section('after_styles')
    <!-- Ladda Buttons (loading buttons) -->
    <link href="{{ asset('vendor/backpack/ladda/ladda-themeless.min.css') }}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
	<style>
		#page-body{
			display: none;
		}

		a > hover{
			text-decoration: none;
		}

		th , tbody{
			text-align: center;
		}
	</style>

    <!-- Bootstrap -->
    {{ HTML::style(asset('css/jquery-ui.css')) }}
    {{ HTML::style(asset('css/sweetalert.css')) }}
    {{ HTML::style(asset('css/dataTables.bootstrap.min.css')) }}
@endsection

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">Purchase Order</h3></legend>
		<ul class="breadcrumb">
			<li><a href="{{ url('purchaseorder') }}">Purchase Order</a></li>
			<li class="active"> {{ $purchaseorder->purchaseorderno }} </li>
		</ul>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
		<div class="panel panel-body table-responsive">
			<table class="table table-hover table-striped table-bordered table-condensed" id="purchaseOrderTable" cellspacing="0" width="100%"	>
				<thead>

		            <tr rowspan="2">
		                <th class="text-left" colspan="4">Purchase Order Number:  <span style="font-weight:normal">{{ $purchaseorder->purchaseorderno }}</span> </th>
		                <th class="text-left" colspan="4">Fund Cluster:  <span style="font-weight:normal">{{ $purchaseorder->fundcluster }}</span> </th>
		            </tr>
		            <tr rowspan="2">
		                <th class="text-left" colspan="4">Details:  <span style="font-weight:normal">{{ $purchaseorder->details }}</span> </th>
		                <th class="text-left" colspan="4">Date:  <span style="font-weight:normal">{{ Carbon\Carbon::parse($purchaseorder->date)->toFormattedDateString() }}</span> </th>
		            </tr>
		            <tr>
						<th>ID</th>
						<th>Supply Item</th>
						<th>Details</th>
						<th>Ordered Quantity</th>
						<th>Received Quantity</th>
						<th>Unit Price</th>
						@if(Auth::user()->accesslevel == 2)
						<th class="col-md-1"></th>
						@endif
					</tr>
				</thead>
			</table>
		</div>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection

@section('after_scripts')
    <!-- Ladda Buttons (loading buttons) -->
    <script src="{{ asset('vendor/backpack/ladda/spin.js') }}"></script>
    <script src="{{ asset('vendor/backpack/ladda/ladda.js') }}"></script>

    {{ HTML::script(asset('js/jquery-ui.js')) }}
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    {{ HTML::script(asset('js/sweetalert.min.js')) }}
    {{ HTML::script(asset('js/jquery.dataTables.min.js')) }}
    {{ HTML::script(asset('js/dataTables.bootstrap.min.js')) }}

<script>
	$(document).ready(function() {

		@if( Session::has("success-message") )
			swal("Success!","{{ Session::pull('success-message') }}","success");
		@endif
		@if( Session::has("error-message") )
			swal("Oops...","{{ Session::pull('error-message') }}","error");
		@endif

	    var table = $('#purchaseOrderTable').DataTable({
			select: {
				style: 'single'
			},
			language: {
					searchPlaceholder: "Search..."
			},
			"processing": true,
			ajax: "{{ url("purchaseorder/$purchaseorder->purchaseorderno") }}",
			columns: [
					{ data: "id" },
					{ data: "supplyitem" },
					{ data: "supply.supplytype" },
					{ data: "orderedquantity" },
					{ data: "receivedquantity" },
					{ data: "unitprice" },
					@if(Auth::user()->accesslevel == 2)
		            { data: function(callback){
		            	return `
		            			<button class="setprice btn btn-sm btn-default" data-id="`+callback.id+`"><span class="glyphicon glyphicon-list"></span> Set Price</button>
		            	`;
		            } }
		            @endif
			],
	    });

	    $('#purchaseOrderTable').on('click','.setprice',function(){
	    	id = $(this).data('id')
	    	swal({
			  title: "Purchase Order",
			  text: "Input Purchase Order Price (Php):",
			  type: "input",
			  showCancelButton: true,
			  closeOnConfirm: false,
			  animation: "slide-from-top",
			  inputPlaceholder: "Php XX.XX"
			},
			function(inputValue){
			  if (inputValue === false) return false;

			  if (inputValue === "") {
			    swal.showInputError("You need to write something!");
			    return false
			  }

			  $.ajax({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
			  	type: 'put',
			  	url: '{{ url("purchaseorder/supply") }}' + '/' + id,
			  	dataType: 'json',
			  	data: {
			  		'unitprice': inputValue
			  	},
			  	success: function(response){
			  		if(response == 'success')
			  		swal('Success','Operation Successful','success')
			  		else
			  		swal('Error','Problem Occurred while processing your data','error')
			  		table.ajax.reload();
			  	},
			  	error: function(){
			  		swal('Error','Problem Occurred while processing your data','error')
			  	}
			  })
			});
	    })

		$('#page-body').show();
	} );
</script>
@endsection
