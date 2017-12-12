@extends('backpack::layout')

@section('header')
	<section class="content-header">
		<legend>
			<h3 class="text-muted">
			    @if( $purchaseorder->supplier->name == config('app.main_agency') )
			    Agency Procurement Request
			    @else
			    Purchase Order
			    @endif
			</h3>
		</legend>
		<ul class="breadcrumb">
			<li><a href="{{ url('purchaseorder') }}">Purchase Order</a></li>
			<li class="active"> {{ $purchaseorder->id }} </li>
		</ul>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
		<div class="panel panel-body table-responsive">
			<a href="{{ url("purchaseorder/$purchaseorder->id/print") }}" target="_blank" id="print" class="print btn btn-sm btn-default ladda-button" data-style="zoom-in">
				<span class="glyphicon glyphicon-print" aria-hidden="true"></span>
				<span id="nav-text"> Print</span>
			</a>
			<hr />
			<table class="table table-hover table-striped table-bordered table-condensed" id="purchaseOrderTable" cellspacing="0" width="100%"	>
				<thead>

		            <tr rowspan="2">
		                <th class="text-left" colspan="4">Purchase Order Number:  <span style="font-weight:normal">{{ $purchaseorder->number }}</span> </th>
		                <th class="text-left" colspan="4">Fund Cluster:  
	                		<span style="font-weight:normal">{{ implode(", ", App\PurchaseOrderFundCluster::findByPurchaseOrderNumber([$purchaseorder->number])->pluck('fundcluster_code')->toArray()) }}</span> 
	                	</th>
		            </tr>
		            <tr rowspan="2">
		                <th class="text-left" colspan="4">Details:  <span style="font-weight:normal">{{ $purchaseorder->details }}</span> </th>
		                <th class="text-left" colspan="4">Date:  <span style="font-weight:normal">{{ Carbon\Carbon::parse($purchaseorder->date_received)->toFormattedDateString() }}</span> </th>
		            </tr>
		            <tr>
						<th>ID</th>
						<th>Stock Number</th>
						<th>Details</th>
						<th>Ordered Quantity</th>
						<th>Received Quantity</th>
						<th>Remaining Quantity</th>
						<th>Unit Price</th>
						<th>Amount</th>
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

    var table = $('#purchaseOrderTable').DataTable({
		select: {
			style: 'single'
		},
		language: {
				searchPlaceholder: "Search..."
		},
		columnDefs:[
			 { targets: 'no-sort', orderable: false },
		],
		"processing": true,
		ajax: "{{ url("purchaseorder/$purchaseorder->id") }}",
		columns: [
			{ data: "id" },
			{ data: "supply.stocknumber" },
			{ data: function(callback){
				html = `<p style="font-size:`;
				length = callback.supply.details.length
				supply = callback.supply.details
				if(length > 60)
				html += "11"
				else if(length > 40)
				html += "12"
				else if(length > 20)
				html += "13"
				html += `px;">`+ supply +"</p>"
				return html;

	    	} },
			{ data: "orderedquantity" },
			{ data: function(callback){
			  if(callback.receivedquantity != 0 && callback.receivedquantity != null)
			  {
			    return callback.receivedquantity
			  }

			  return `0`;
			} },
			{ data: "remainingquantity" },
			{ data: function(callback){
				if(callback.unitcost == "" || callback.unitcost == null)
					return 0
				return (callback.unitcost).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
			} },
			{ data: function(callback){
				if(callback.unitcost == "" || callback.unitcost == null)
					return 0
				return (callback.receivedquantity * callback.unitcost).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
			} }
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
	} );
</script>
@endsection
