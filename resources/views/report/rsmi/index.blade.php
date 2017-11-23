@extends('backpack::layout')

@section('header')
	<section class="content-header">
    <legend><h3 class="text-muted">Reports on Supplies and Materials Issued</h3></legend>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box" style="padding:10px;">
    <div class="box-body">
    	<div>

			  <!-- Nav tabs -->
			  <ul class="nav nav-tabs" role="tablist">
			    <li role="presentation" class="active"><a href="#total" aria-controls="total" role="tab" data-toggle="tab">Issued Slip</a></li>
			    <li role="presentation"><a href="#recap" aria-controls="recap" role="tab" data-toggle="tab">Supply</a></li>
			  </ul>

			  <!-- Tab panes -->
			  <div class="tab-content">
			    <div role="tabpanel" class="tab-pane fade in active" id="total" style="padding:10px;">
					    	
					<table class="table table-hover table-striped table-bordered table-condensed" id="rsmiTable" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>RIS No.</th>
								<th>Responsibility Center Code</th>
								<th>Stock No.</th>
								<th>Item</th>
								<th>Unit</th>
								<th>Qty Issued</th>
								<th>Unit Cost</th>
								<th>Amount</th>
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
						return callback.issued * callback.cost
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
					{ data: "cost"},
					{ data: function(callback){
						return callback.issued * callback.cost
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
    				option += `<option val='` + moment(obj).format("MMM YYYY") + `'>` + moment(obj).format("MMM YYYY") + `</option>'`
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
			if(moment(date).isValid())
			date = moment(date).format('MMMMYYYY')
			else
			date = moment().format('MMMMYYYY')
    		rsmitableurl = '{{ url("rsmi") }}' + '/' + date
    		rsmitotaltableurl = '{{ url("rsmi") }}' + '/' + date + '/recapitulation';
    		rsmitable.ajax.url(rsmitableurl).load()
    		rsmitotaltable.ajax.url(rsmitotaltableurl).load()
    	}
	} );
</script>
@endsection
