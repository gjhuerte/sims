@extends('backpack::layout')

@section('after_styles')
    <!-- Ladda Buttons (loading buttons) -->
    <link href="{{ asset('vendor/backpack/ladda/ladda-themeless.min.css') }}" rel="stylesheet" type="text/css" />
		{{ HTML::style(asset('css/buttons.bootstrap.min.css')) }}
		{{ HTML::style(asset('css/buttons.dataTables.min.css')) }}
		{{ HTML::style(asset('css/select.bootstrap.min.css')) }}
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
		<legend><h3 class="text-muted">Supply Ledger Summary</h3></legend>
		<ul class="breadcrumb">
			<li><a href="{{ url('inventory/supply') }}">Inventory</a></li>
			<li class="active">{{ $supply->stocknumber }}</li>
			<li class="active">Supply Ledger</li>
			<li class="active">Summary</li>
		</ul>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box" style="padding:10px;">
    <div class="box-body">
		<div class="panel panel-body table-responsive">
			<table class="table table-hover table-striped table-bordered table-condensed" id="inventoryTable" cellspacing="0" width="100%">
				<thead>
		            <tr rowspan="2">
		                <th class="text-left" colspan="7">Entity Name:  <span style="font-weight:normal">{{ $supply->entityname }}</span> </th>
		                <th class="text-left" colspan="7"></span> </th>
		            </tr>
		            <tr rowspan="2">
		                <th class="text-left" colspan="7">Item:  <span style="font-weight:normal">{{ $supply->supplytype }}</span> </th>
		                <th class="text-left" colspan="7">Stock No.:  <span style="font-weight:normal">{{ $supply->stocknumber }}</span> </th>
		            </tr>
		            <tr rowspan="2">
		                <th class="text-left" colspan="7">Unit Of Measurement:  <span style="font-weight:normal">{{ $supply->unit }}</span>  </th>
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
						<th>Days To Consume</th>
						<th class="no-sort"></th>
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
		{{ HTML::script(asset('js/dataTables.select.min.js')) }}
		{{ HTML::script(asset('js/dataTables.buttons.min.js')) }}
		{{ HTML::script(asset('js/buttons.html5.min.js')) }}
		{{ HTML::script(asset('js/buttons.print.min.js')) }}
		{{ HTML::script(asset('js/jszip.min.js')) }}
		{{ HTML::script(asset('js/pdfmake.min.js')) }}
		{{ HTML::script(asset('js/vfs_fonts.js')) }}
		{{ HTML::script(asset('js/buttons.bootstrap.min.js')) }}
	<script type="text/javascript">
		$(document).ready(function() {

				var quantity = 0;
				var unitcost = 0;
				var totalcost = 0;

				@if( Session::has("success-message") )
					swal("Success!","{{ Session::pull('success-message') }}","success");
				@endif
				@if( Session::has("error-message") )
					swal("Oops...","{{ Session::pull('error-message') }}","error");
				@endif

		    var table = $('#inventoryTable').DataTable({
					"pageLength": 50,
					select: {
						style: 'single'
					},
					"columnDefs":[
						{ "type": "date", "targets": 0 },
						{ targets: 'no-sort', orderable: false }
					],
					language: {
							searchPlaceholder: "Search..."
					},
					"dom": "<'row'<'col-sm-3'l><'col-sm-6'<'toolbar'>><'col-sm-3'f>>" +
									"<'row'<'col-sm-12'tr>>" +
									"<'row'<'col-sm-5'i><'col-sm-7'p>>",
					"processing": true,
					ajax: '{{ url("inventory/supply/$supply->stocknumber/supplyledger/") }}',
					columns: [
							{ data: "date" },
							{ data: function(){
								return ""
							} },
							{ data: "receiptquantity"},
							{ data: function(callback){
								try{
									return parseInt(callback.receiptunitprice).toFixed(2)
								} catch(e) { quantity = 0; return null }
							} },
							{ data: function(callback){
								try {
									return (callback.receiptquantity * callback.receiptunitprice).toFixed(2);
								} catch (e) { return null }
							} },
							{ data: "issuequantity" },
							{ data: function(callback){
								try{
									return parseInt(callback.issueunitprice)
								} catch(e) { quantity = 0; return null }
							} },
							{ data: function(callback){
								try {
									return (callback.issuequantity * callback.issueunitprice).toFixed(2);
								} catch (e) { return null }
							} },
							{ data: function(callback){
								try{
									quantity = callback.balancequantity
									return quantity;
								} catch(e) { quantity = 0; return null }
							} },
							{ data: function(callback){
								try{
									unitcost = (parseInt(callback.issueunitprice) + parseInt(callback.receiptunitprice)) / 2
									return unitcost
								} catch(e) { unitcost = 0; return null }
							} },
							{ data: function(callback){
								try{
									return (quantity * unitcost).toFixed(2);
								} catch (e) { return null }
							} },
							{ data: function(){
								return ""
							} },
							{ data: function(callback){
								url = '{{ url("inventory/supply/$supply->stocknumber/supplyledger") }}' + '/' + callback.date
								return "<a type='button' href='" + url + "' class='btn btn-default btn-sm'>View</a>"
							} },
					],
		    });

			 	$("div.toolbar").html(`
          <button href="{{ url("inventory/supply/$supply->stocknumber/supplyledger/print") }}" id="print" class="print btn btn-sm btn-default ladda-button" data-style="zoom-in">
            <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
            <span id="nav-text"> Print</span>
          </button>
					<button id="accept" class="btn btn-sm btn-success">
						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
						<span id="nav-text"> Accept</span>
					</button>
					<button id="release" class="btn btn-sm btn-danger">
						<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
						<span id="nav-text"> Release</span>
					</button>
				`);

				$('#accept').on('click',function(){
					window.location.href = "{{ url('inventory/supply') }}" + '/' + "{{ $supply->stocknumber }}" + '/supplyledger/create'
				});

				$('#release').on('click',function(){
					window.location.href = "{{ url('inventory/supply') }}" + '/' + "{{ $supply->stocknumber }}" + '/supplyledger/release'
				});

        $('#print').on('click', function(){
          html = ''
          progress = 0
          $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'get',
            url: '{{ url("inventory/supply/$supply->stocknumber/supplyledger/print") }}',
            dataType: 'html',
            success: function(callback){
              // Create a new instance of ladda for the specified button
              var l = Ladda.create( document.querySelector( '#print' ) );

              // Start loading
              l.start();
              $('<iframe>', {
                name: 'myiframe',
                class: 'printFrame'
              })

              .appendTo('body')
              .contents().find('body')

              .append(callback);

              setInterval(function(){

                    l.setProgress( progress );
                    progress = progress +  0.1
              },300)
              $('.printFrame').hide()
              setTimeout(function(){
                l.stop();
                $('.printFrame').show()
                window.frames['myiframe'].focus();
                window.frames['myiframe'].print();
                $('.printFrame').remove()
              },3000)
            }
          })
          // e.preventDefault()
        });

				$('#page-body').show();
      });
</script>
@endsection
