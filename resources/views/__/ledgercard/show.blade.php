@extends('backpack::layout')

@section('header')
	<section class="content-header">
			<legend><h3 class="text-muted">Supply Ledger as of {{ $month }}</h3></legend>
			<ul class="breadcrumb">
				<li><a href="{{ url('inventory/supply') }}">Supply Inventory</a></li>
				<li><a href="{{ url("inventory/supply/$supply->id/ledgercard") }}">{{ $supply->stocknumber }}</a></li>
				<li class="active">{{ $month }}</li>
			</ul>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
		<div class="panel panel-body table-responsive">
			<a href="{{ url("inventory/supply/$supply->stocknumber/ledgercard/print") }}" target="_blank" id="print" class="print btn btn-sm btn-default ladda-button" data-style="zoom-in">
				<span class="glyphicon glyphicon-print" aria-hidden="true"></span>
				<span id="nav-text"> Download</span>
			</a>
			<hr />
			<table class="table table-hover table-bordered" id="supplyLedgerTable">
				<thead>
		            <tr rowspan="2">
		                <th class="text-left" colspan="14">Entity Name:  <span style="font-weight:normal">{{ $supply->entityname }}</span> </th>
		            </tr>
		            <tr rowspan="2">
		                <th class="text-left" colspan="7">Item:  <span style="font-weight:normal">{{ $supply->details }}</span> </th>
		                <th class="text-left" colspan="7">Stock No.:  <span style="font-weight:normal">{{ $supply->stocknumber }}</span> </th>
		            </tr>
		            <tr rowspan="2">
		                <th class="text-left" colspan="7">Unit Of Measurement:  <span style="font-weight:normal">{{ $supply->unit->name }}</span>  </th>
		                <th class="text-left" colspan="7">Reorder Point: <span style="font-weight:normal">{{ $supply->reorderpoint }}</span> </th>
		            </tr>
		            <tr rowspan="2">
		                <th class="text-center" colspan="2"></th>
		                <th class="text-center" colspan="3">Receipt</th>
		                <th class="text-center" colspan="3">Issue</th>
		                <th class="text-center" colspan="3">Balance</th>
		                <th class="text-center" colspan="2"></th>
		            </tr>
					<tr>
						<th>Date</th>
						<th>Reference</th>
						<th>Qty</th>
						<th>Unit Cost</th>
						<th>Total Cost</th>
						<th>Qty</th>
						<th>Unit Cost</th>
						<th>Total Cost</th>
						<th>Qty</th>
						<th>Unit Cost</th>
						<th>Total Cost</th>
						<th class="no-sort"></th>
					</tr>
				</thead>
				<tbody>
				@foreach($ledgercard as $ledgercard)
					<tr>
						<td>{{ Carbon\Carbon::parse($ledgercard->date)->format('M d Y') }}</td>
						<td>{{ $ledgercard->reference }}</td>
						<td>{{ $ledgercard->received_quantity }}</td>
						<td>{{ number_format($ledgercard->received_unitcost, 2) }}</td>
						<td>{{ number_format($ledgercard->received_quantity * $ledgercard->received_unitcost, 2) }}</td>
						<td>{{ $ledgercard->issued_quantity }}</td>
						<td>{{ number_format($ledgercard->issued_unitcost, 2) }}</td>
						<td>{{ number_format($ledgercard->issued_quantity * $ledgercard->issued_unitcost, 2) }}</td>
						<td>{{ $ledgercard->balance_quantity }}</td>
						@if($ledgercard->received_quantity != 0 && isset($ledgercard->received_quantity))
						<td>{{ number_format($ledgercard->received_unitcost, 2) }}</td>
						@else
						<td>{{ number_format($ledgercard->issued_unitcost, 2) }}</td>
						@endif
						@if($ledgercard->received_quantity != 0 && isset($ledgercard->received_quantity))
						<td>{{ number_format($ledgercard->received_unitcost *  $ledgercard->balance_quantity, 2) }}</td>
						@else
						<td>{{ number_format( $ledgercard->issued_unitcost *  $ledgercard->balance_quantity, 2) }}</td>
						@endif
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection

@section('after_scripts')

<script>
$('document').ready(function(){
    var table = $('#supplyLedgerTable').DataTable();
})
</script>
@endsection
