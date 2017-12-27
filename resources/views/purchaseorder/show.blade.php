@extends('backpack::layout')

@section('header')
	<section class="content-header">
		<legend>
			<h3 class="text-muted">
			    @if( $purchaseorder->supplier->name == config('app.main_agency') && isset($purchaseorder->supplier) )
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
            <button type="button" id="updateFundCluster" class="copy btn btn-primary btn-sm">Update Fund Cluster</button>
			<hr />
			<table class="table table-hover table-striped table-bordered table-condensed" id="purchaseOrderTable" cellspacing="0" width="100%"	>
				<thead>

		            <tr rowspan="2">
		                <th class="text-left" colspan="4">Code:  <span style="font-weight:normal">{{ isset($purchaseorder->number) ? $purchaseorder->number : "" }}</span> </th>
		                <th class="text-left" colspan="4">Fund Cluster:  
	                		<span style="font-weight:normal">{{ implode(", ", App\PurchaseOrderFundCluster::findByPurchaseOrderNumber([isset($purchaseorder->number) ? $purchaseorder->number : ""])->pluck('fundcluster_code')->toArray()) }}</span> 
	                	</th>
		            </tr>
		            <tr rowspan="2">
		                <th class="text-left" colspan="4">Details:  <span style="font-weight:normal">{{ isset($purchaseorder->details) ? $purchaseorder->details : "" }}</span> </th>
		                <th class="text-left" colspan="4">Date:  <span style="font-weight:normal">{{ isset($purchaseorder->date_received) ? Carbon\Carbon::parse($purchaseorder->date_received)->toFormattedDateString() : "" }}</span> </th>
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
    	serverSide: true,
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
			{ data: "supply.details" },
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

    $('#updateFundCluster').on('click',function(){
    	id = "{{ isset($purchaseorder->id) ? $purchaseorder->id : null }}"
    	swal({
			  title: "Purchase Order",
			  text: "Input Fund Clusters:",
			  type: "input",
			  showCancelButton: true,
			  closeOnConfirm: false,
			  animation: "slide-from-top",
			  inputPlaceholder: "Comma separate each fund cluster",
			  inputValue: "{{ implode(", ", App\PurchaseOrderFundCluster::findByPurchaseOrderNumber([isset($purchaseorder->number) ? $purchaseorder->number : ""])->pluck('fundcluster_code')->toArray()) }}"
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
			  	url: '{{ url("purchaseorder") }}' + '/' + id,
			  	dataType: 'json',
			  	data: {
			  		'fundcluster': inputValue
			  	},
			  	success: function(response){
			  		if(response == 'success')
			  		swal('Success','Operation Successful','success')
			  		else
			  		swal('Error','Problem Occurred while processing your data','error')
			  		location.reload()	
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
