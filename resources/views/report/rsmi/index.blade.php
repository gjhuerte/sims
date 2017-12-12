@extends('backpack::layout')

@section('after_styles')
<style>
	th {
		white-space: nowrap;
	}
</style>
@endsection

@section('header')
	<section class="content-header">
    <legend><h3 class="text-muted">Reports on Supplies and Materials Issued</h3></legend>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box" style="padding:10px;">
    <div class="box-body">
		<button type="button" href="{{ url("rsmi/print") }}" target="_blank" id="print" class="print btn btn-sm btn-default ladda-button" data-style="zoom-in">
			<span class="glyphicon glyphicon-print" aria-hidden="true"></span>
			<span id="nav-text"> Print</span>
		</button>
		<hr />

		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active">
				<a href="#total" aria-controls="total" role="tab" data-toggle="tab">Requisition and Issue Slip</a></li>
			<li role="presentation"><a href="#recap" aria-controls="recap" role="tab" data-toggle="tab">Recapitulation</a></li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane fade in active" id="total" style="padding:10px;">
				    	
				<table class="table table-hover table-striped table-bordered table-condensed" id="rsmiTable" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th class="col-sm-1">RIS No.</th>
							<th class="col-sm-1">Responsibility Center Code</th>
							<th class="col-sm-1">Stock No.</th>
							<th class="col-sm-1">Item</th>
							<th class="col-sm-1">Unit</th>
							<th class="col-sm-1">Qty Issued</th>
							<th class="col-sm-1">Unit Cost</th>
							<th class="col-sm-1">Amount</th>
						</tr>
					</thead>
				</table>

		    </div>
		    <div role="tabpanel" class="tab-pane fade" id="recap" style="padding:10px;">

				<table class="table table-hover table-striped table-bordered table-condensed" id="rsmiTotalTable" cellspacing="0" width="100%">
					<thead>
	            <tr rowspan="2">
	                <th class="text-left text-center" colspan="8">Recapitulation</th>
	            </tr>
						<tr>
							<th>Stock No.</th>
							<th>Qty</th>
							<th>Item Description</th>
							<th>Unit Cost</th>
							<th>Total Cost</th>
							<th>UACS Object Code</th>
						</tr>
					</thead>
				</table>
		    	
		    </div>
		  </div>

		</div>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection

@section('after_scripts')
<script type="text/javascript">
	$(document).ready(function() {

		var balance = 0;
		var date = moment().format('MMMMYYYY');

	    var rsmitable = $('#rsmiTable').DataTable({
			language: {
					searchPlaceholder: "Search..."
			},
			"dom": "<'row'<'col-sm-3'l><'col-sm-3'B<'print'>><'col-sm-3'<'toolbar'>><'col-sm-3'f>>" +
							"<'row'<'col-sm-12'tr>>" +
							"<'row'<'col-sm-5'i><'col-sm-7'p>>",
			"processing": true,
			ajax: '{{ url("rsmi") }}' + '/' + date,
			columns: [
					{ data: "reference" },
					{ data: "office" },
					{ data: "stocknumber"},
					{ data: "details" },
					{ data: "unit" },
					{ data: "issued" },
					{ data: "cost"},
					{ data: function(callback){
						return (callback.issued * callback.cost).toFixed(2).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
					}},
			],
	    });

	    var rsmitotaltable = $('#rsmiTotalTable').DataTable({
			language: {
					searchPlaceholder: "Search..."
			},
			"dom": "<'row'<'col-sm-3'l><'col-sm-6'B<'totalprint'>><'col-sm-3'f>>" +
							"<'row'<'col-sm-12'tr>>" +
							"<'row'<'col-sm-5'i><'col-sm-7'p>>",
			"processing": true,
			ajax: '{{ url("rsmi") }}' + '/' + date + '/recapitulation',
			columns: [
					{ data: "stocknumber" },
					{ data: "issued" },
					{ data: "details"},
					{ data: function(callback){
						if(callback.cost != null && callback.cost >= 0)
						return parseFloat(callback.cost).toFixed(2).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
						return 0
					}},
					{ data: function(callback){
						return (callback.issued * callback.cost).toFixed(2).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
					}},
					{ data: function(){
						return ""
					} },
			],
	    });

	    $('div.toolbar').html(`
	    	<label for="month">Month Filter:</label>
	    	<select class="form-control" id="month"></select>
    	`);

    	$.ajax({
    		type: 'get',
    		url: "{{ url('rsmi/months') }}",
    		dataType: 'json',
    		success: function(response){
    			option = ""
    			$.each(response.data,function(obj){
	    			date = moment(obj,"MM YYYY").format("MMM YYYY")
    				option += `<option val='` + date + `'>` + date + `</option>'`
    				$('#month').html("")
    				$('#month').append(option)
    			})

    			reloadTable()
    		}
    	})

    	$('#month').on('change',function(){
    		reloadTable()
    	})

    	function reloadTable()
    	{
			date = $('#month').val()
			if(moment(date,"MMMMYYYY").isValid())
			date = moment(date,"MMMMYYYY").format('MMMM YYYY')
			else
			date = moment().format('MMMM YYYY')
    		rsmitableurl = '{{ url("rsmi") }}' + '/' + date
    		rsmitotaltableurl = '{{ url("rsmi") }}' + '/' + date + '/recapitulation';

    		rsmitable.ajax.url(rsmitableurl).load()
    		rsmitotaltable.ajax.url(rsmitotaltableurl).load()
    	}

    	$('#print').on('click',function(){
    		month = $('#month').val()
    		url = "{{ url('rsmi') }}" + '/' + month + '/print'
    		window.open(url, '_blank');
    	})
	} );
</script>
@endsection
