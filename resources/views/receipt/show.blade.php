@extends('backpack::layout')

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">Receipt {{ $receipt->number }} Details</h3></legend>
		<ul class="breadcrumb">
			<li><a href="{{ url('receipt') }}">Receipt</a></li>
			<li class="active"> {{ $receipt->code }} </li>
		</ul>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
		<div class="panel panel-body table-responsive">
	         <a href="{{ url("receipt/$receipt->number/print") }}" target="_blank" id="print" class="print btn btn-sm btn-default ladda-button" data-style="zoom-in">
	          <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
	          <span id="nav-text"> Print</span>
	        </a>
			<hr />
			<table class="table table-hover table-striped table-bordered table-condensed" id="receiptTable" cellspacing="0" width="100%"	>
				<thead>
			          <tr rowspan="2">
			              <th class="text-left" colspan="3">Receipt:  <span style="font-weight:normal">{{ $receipt->number }}</span> </th>
			              <th class="text-left" colspan="3">Supplier:  <span style="font-weight:normal">{{ $receipt->supplier_name }}</span> </th>
			          </tr>
			          <tr rowspan="2">
			              <th class="text-left" colspan="3">Invoice:  <span style="font-weight:normal">{{ $receipt->invoice }}</span> </th>
			              <th class="text-left" colspan="3">Date Delivered:  <span style="font-weight:normal">{{ Carbon\Carbon::parse($receipt->date_delivered)->toFormattedDateString() }}</span> </th>
			          </tr>
			          <tr>
						<th class="col-sm-1">Stock Number</th>
						<th class="col-sm-1">Delivered Quantity</th>
						<th class="col-sm-1">Remaining Quantity</th>
						<th class="col-sm-1">Unit Cost</th>
						<th class="col-sm-1">Total Amount</th>
						<th class="no-sort col-sm-1"></th>
					</tr>
				</thead>
			</table>
		</div>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection

@section('after_scripts')

<script>
	$(document).ready(function() {

	    var table = $('#receiptTable').DataTable({
				language: {
						searchPlaceholder: "Search..."
				},
				"dom": "<'row'<'col-sm-3'l><'col-sm-6'<'toolbar'>><'col-sm-3'f>>" +
								"<'row'<'col-sm-12'tr>>" +
								"<'row'<'col-sm-5'i><'col-sm-7'p>>",
				"processing": true,
		        columnDefs:[
		            { targets: 'no-sort', orderable: false },
		        ],
				ajax: "{{ url("receipt/$receipt->number") }}",
				columns: [
					{ data: "stocknumber" },
					{ data: "quantity" },
					{ data: "remaining_quantity" },
					{ data: function(callback){
						if(callback.cost == "" || callback.cost == null)
							return 0
						return (callback.cost).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
					} },
					{ data: function(callback){
						if(callback.cost == "" || callback.cost == null)
							return 0
						return (callback.quantity * callback.cost).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
					} },
					{ data: function(callback){
						return `
					         <button data-id="{{ $receipt->number }}" data-stocknumber="`+callback.stocknumber+`" class="edit btn btn-sm btn-primary ladda-button" data-style="zoom-in">
					          <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
					          <span id="nav-text"> Update Price</span>
					        </button>
					        `
					}}
				],
	    });

	    $('div.toolbar').html(`
	    `)

	    $('#receiptTable').on('click','.edit',function(){
	    	id = $(this).data('id')
	    	stocknumber = $(this).data('stocknumber')
	    	swal({
			  title: "Receipt",
			  text: "Input Unit Cost (Php):",
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
			  	url: '{{ url("receipt") }}' + '/' +  id,
			  	dataType: 'json',
			  	data: {
			  		'unitprice': inputValue,
			  		'stocknumber': stocknumber
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

		} );
	} );
</script>
@endsection
