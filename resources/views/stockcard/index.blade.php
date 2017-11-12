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
  	{{ HTML::style(asset('css/buttons.bootstrap.min.css')) }}
  	{{ HTML::style(asset('css/buttons.dataTables.min.css')) }}
  	{{ HTML::style(asset('css/select.bootstrap.min.css')) }}
  	<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
@endsection

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">Stock Card</h3></legend>
		<ul class="breadcrumb">
			<li><a href="{{ url('inventory/supply') }}">Inventory</a></li>
			<li class="active">{{ $supply->stocknumber }}</li>
			<li class="active">Stock Card</li>
		</ul>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box" style="padding:10px">
    <div class="box-body">
			<table class="table table-hover table-striped table-bordered table-condensed" id="inventoryTable" cellspacing="0" width="100%">
				<thead>
		            <tr rowspan="2">
		                <th class="text-left" colspan="4">Entity Name:  <span style="font-weight:normal">{{ $supply->entityname }}</span> </th>
		                <th class="text-left" colspan="4">Fund Cluster:  <span style="font-weight:normal">
		                @foreach($supply->purchaseorder as $supplypurchaseorder)
		                {{ $supplypurchaseorder->fundcluster."," }}
		                @endforeach
		                </span> </th>
		            </tr>
		            <tr rowspan="2">
		                <th class="text-left" colspan="4">Item:  <span style="font-weight:normal">{{ $supply->supplytype }}</span> </th>
		                <th class="text-left" colspan="4">Stock No.:  <span style="font-weight:normal">{{ $supply->stocknumber }}</span> </th>
		            </tr>
		            <tr rowspan="2">
		                <th class="text-left" colspan="4">Unit Of Measurement:  <span style="font-weight:normal">{{ $supply->unit }}</span>  </th>
		                <th class="text-left" colspan="4">Reorder Point: <span style="font-weight:normal">{{ $supply->reorderpoint }}</span> </th>
		            </tr>
					<tr>
						<th>Date</th>
						<th>Reference</th>
						<th>Receipt Qty</th>
						<th>Issue Qty</th>
						<th>Office</th>
						<th>Balance Qty</th>
						<th>Days To Consume</th>
					</tr>
				</thead>
			</table>
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
  	{{ HTML::script(asset('js/moment.min.js')) }}
  	{{ HTML::script(asset('js/jquery.printPage.js')) }}

<script>
	$(document).ready(function() {

		@if( Session::has("success-message") )
			swal("Success!","{{ Session::pull('success-message') }}","success");
		@endif
		@if( Session::has("error-message") )
			swal("Oops...","{{ Session::pull('error-message') }}","error");
		@endif

	    var table = $('#inventoryTable').DataTable({
			select: {
				style: 'single'
			},
			language: {
					searchPlaceholder: "Search..."
			},
			"dom": "<'row'<'col-sm-3'l><'col-sm-6'<'toolbar'>><'col-sm-3'f>>" +
							"<'row'<'col-sm-12'tr>>" +
							"<'row'<'col-sm-5'i><'col-sm-7'p>>",
			"columnDefs":[
				{ "type": "date", "targets": 0 },
			],
			"processing": true,
			ajax: '{{ url("inventory/supply/$supply->stocknumber/stockcard/") }}',
			columns: [
					{ data: function(callback){
						return moment(callback.date).format("MMMM Do YYYY")
					} },
					{ data: "reference" },
					{ data: function(callback){
						if(callback.receiptquantity == null)
							return 0
						else
							return callback.receiptquantity
					}},
					{ data: function(callback){
						if(callback.issuequantity == null)
							return 0
						else
							return callback.issuequantity
					}},
					{ data: function(callback){
						if(callback.office == null || callback.office == "")
							return "N/A"
						else
							return callback.office
					}},
					{ data: "balance" },
					{ data: function(callback){
						if(callback.daystoconsume == null || callback.daystoconsume == "")
							return "N/A"
						else
							return callback.daystoconsume
					}},
			],
	    });


	      // <button href="{{ url("inventory/supply/$supply->stocknumber/stockcard/print") }}" id="print" class="print btn btn-sm btn-default ladda-button" data-style="zoom-in">
	      //    <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
	      //    <span id="nav-text"> Print</span>
	      // </button>

	 	$("div.toolbar").html(`
	       <a href="{{ url("inventory/supply/$supply->stocknumber/stockcard/print") }}" target="_blank" id="print" class="print btn btn-sm btn-default ladda-button" data-style="zoom-in">
	        <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
	        <span id="nav-text"> Print</span>
	      </a>
			<button type="button" id="accept" class="btn btn-sm btn-success">
				<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				<span id="nav-text"> Accept</span>
			</button>
			<button type="button" id="release" class="btn btn-sm btn-danger">
				<span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
				<span id="nav-text"> Release</span>
			</button>
		`);

		$('#accept').on('click',function(){
			window.location.href = "{{ url("inventory/supply/$supply->stocknumber/stockcard/create") }}"
		});

		$('#release').on('click',function(){
			window.location.href = "{{ url("inventory/supply/$supply->stocknumber/stockcard/release") }}"
		});

    $("#print").on('click',function(e){
      var win = window.open("{{ url("inventory/supply/$supply->stocknumber/stockcard/print") }}", '_blank');
      if (win) {
          //Browser has allowed it to be opened
          win.focus();
      } else {
          //Browser has blocked it
          alert('Please allow popups for this website');
      }
        e.preventDefault();
    })

    // $('#print').on('click', function(){
    //   html = ''
    //   progress = 0
    //   $.ajax({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     },
    //     type: 'get',
    //     url: '{{ url("inventory/supply/$supply->stocknumber/stockcard/print") }}',
    //     dataType: 'html',
    //     success: function(callback){
    //       // Create a new instance of ladda for the specified button
    //       var l = Ladda.create( document.querySelector( '#print' ) );

    //       // Start loading
    //       l.start();
    //       $('<iframe>', {
    //         name: 'myiframe',
    //         class: 'printFrame'
    //       })

    //       .appendTo('body')
    //       .contents().find('body')

    //       .append(callback);

    //       setInterval(function(){

    //             l.setProgress( progress );
    //             progress = progress +  0.1
    //       },300)
    //       $('.printFrame').hide()
    //       setTimeout(function(){
    //         l.stop();
    //         $('.printFrame').show()
    //         window.frames['myiframe'].focus();
    //         window.frames['myiframe'].print();
    //         $('.printFrame').remove()
    //       },3000)
    //     }
    //   })
    //   // e.preventDefault()
    // });

		$('#page-body').show();
	} );
</script>
@endsection
