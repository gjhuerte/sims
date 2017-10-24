@extends('backpack::layout')

@section('after_styles')
    <!-- Ladda Buttons (loading buttons) -->
    <link href="{{ asset('vendor/backpack/ladda/ladda-themeless.min.css') }}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
	<style>
		#page-body{
			display:none;
		}

		td {
			font-size: 10px;
		}
	</style>

    <!-- Bootstrap -->
    {{ HTML::style(asset('css/jquery-ui.css')) }}
    {{ HTML::style(asset('css/sweetalert.css')) }}
    {{ HTML::style(asset('css/dataTables.bootstrap.min.css')) }}
	{{ HTML::style(asset('css/buttons.bootstrap.min.css')) }}
	{{ HTML::style(asset('css/buttons.dataTables.min.css')) }}
	{{ HTML::style(asset('css/select.bootstrap.min.css')) }}
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
								@if(false)
								<th class="no-sort"></th>
								@endif
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
		{{ HTML::script(asset('js/moment.min.js')) }}
		<script type="text/javascript">
			$(document).ready(function() {

				var balance = 0;
				var date = moment().format('MMMMYYYY');

				@if( Session::has("success-message") )
					swal("Success!","{{ Session::pull('success-message') }}","success");
				@endif
				@if( Session::has("error-message") )
					swal("Oops...","{{ Session::pull('error-message') }}","error");
				@endif

				// function getRSMITable()
				// {
				// 	return rsmiTotalTable.fnGetData();
				// }

			    var rsmitable = $('#rsmiTable').DataTable({
		        	buttons: [
		        					{
			    						extend: 'excel',
						                exportOptions: {
						                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
						                }

		        					},
		        					{
			    						extend: 'print',
			    						title: '',
			    						messageBottom: "*** Nothing Follows ***",
		                				message: function(){
		                					return `
		                					<p class="text-center">Polytechnic University of the Philippines </p>
		                					<p class="text-center">Property and Supplies Office"</p><br /><br />
		                					<p class="text-center"><b>Report on Supplies and Materials Issued</b></p> `;
		                				},
						                customize: function ( win ) {
						                    $(win.document.body)
						                        .css( 'font-size', '10pt' )
						                        .append(
						                        		$('#rsmiTotalTable').clone(),`
												    	<legend></legend>
														<br /><br />
														<p> I hereby certify to the correctness to the above information </p>
														<p> <u> VIRGILIO T. MAURICIO</u> </p>
														<p> Chief, Asset Management Office </p>
														<br /><br />
														<p> Posted By: </p>
														<br /><hr/>
														<p> Signature Over Printed Name of Designated Accounting Staff </p>`
						                        	);

						                    $(win.document.body).find( 'table' )
						                        .addClass( 'compact' )
						                        .css( 'font-size', 'inherit' );
						                },
						                exportOptions: {
						                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
						                }

		        					}
		    				 ],
					initComplete : function () {
		     			rsmitable.buttons().container()
		        			.appendTo( 'div.print' );
		    		},
					language: {
							searchPlaceholder: "Search..."
					},
					"dom": "<'row'<'col-sm-3'l><'col-sm-3'B<'print'>><'col-sm-3'<'toolbar'>><'col-sm-3'f>>" +
									"<'row'<'col-sm-12'tr>>" +
									"<'row'<'col-sm-5'i><'col-sm-7'p>>",
					"processing": true,
					ajax: '{{ url("inventory/supply/rsmi") }}' + '/' + date,
					columns: [
							{ data: "reference" },
							{ data: "office" },
							{ data: "stocknumber"},
							{ data: "supplytype" },
							{ data: "unit" },
							{ data: "issuequantity" },
							{ data: function(callback){
								try{
									@if(Auth::user()->accesslevel == 2)
									return callback.unitprice
									@else
									return ""
									@endif
								} catch(e) { return null }
							}},
							{ data: function(callback){
								try{
									@if(Auth::user()->accesslevel == 2)
									return callback.amount
									@else
									return ""
									@endif
								} catch(e) { return null }
							}},
							@if(false)
							{ data: function(callback){
								return "<button type='button' class='copy btn btn-default btn-sm' data-stocknumber='"+callback.stocknumber+"'  data-reference='"+callback.reference+"' data-quantity='"+callback.issuequantity+"' >Create Own Copy</button>"
							} },
							@endif
					],
			    });

			    var rsmitotaltable = $('#rsmiTotalTable').DataTable({
		        	buttons: [
		        					{
		        						extend: 'excel'
		        					}
		    				 ],
					initComplete : function () {
		     			rsmitotaltable.buttons().container()
		        			.appendTo( 'div.totalprint' );
		    		},
					language: {
							searchPlaceholder: "Search..."
					},
					"dom": "<'row'<'col-sm-3'l><'col-sm-6'B<'totalprint'>><'col-sm-3'f>>" +
									"<'row'<'col-sm-12'tr>>" +
									"<'row'<'col-sm-5'i><'col-sm-7'p>>",
					"processing": true,
					ajax: '{{ url("inventory/supply/rsmi/total/bystocknumber") }}' + '/' + date,
					columns: [
							{ data: "stocknumber" },
							{ data: "issuequantity" },
							{ data: "supplytype"},
							{ data: function(callback){
								@if(Auth::user()->accesslevel == 2)
								return callback.unitprice
								@else
								return ""
								@endif
							} },
							{ data: function(callback){
								@if(Auth::user()->accesslevel == 2)
								total = callback.unitprice * callback.issuequantity
								if(!isNaN(total))
								{
									return total
								}
								@else
								return ""
								@endif

								return "";
							} },
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
		    		url: "{{ url('get/supply/inventory/stockcard/months/all') }}",
		    		dataType: 'json',
		    		success: function(response){
		    			option = ""
		    			$.each(response.data,function(obj){
		    				option += `<option val='` + moment(response.data[obj]).format("MMM YYYY") + `'>` + moment(response.data[obj]).format("MMM YYYY") + `</option>'`
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
		    		rsmitableurl = '{{ url("inventory/supply/rsmi") }}' + '/' + date
		    		rsmitotaltableurl = '{{ url("inventory/supply/rsmi/total/bystocknumber") }}' + '/' + date;
		    		rsmitable.ajax.url(rsmitableurl).load()
		    		rsmitotaltable.ajax.url(rsmitotaltableurl).load()
		    	}

		    	$('#rsmiTable').on('click','.copy',function(){
		    		quantity = $(this).data('quantity')
		    		reference = $(this).data('reference')
		    		stocknumber = $(this).data('stocknumber')
  					date = $('#month').val()
  					date = moment(date).format('MMMMYYYY')

			        swal({
			          title: "Are you sure?",
			          text: "This record will be copied to your list. Do you want to continue?",
			          type: "warning",
			          showCancelButton: true,
			          confirmButtonText: "Yes",
			          cancelButtonText: "No",
			          closeOnConfirm: false,
			          closeOnCancel: false
			        },
			        function(isConfirm){
			          if (isConfirm) {
			          		$.ajax({
							    headers: {
							        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							    },
			          			url: "{{ route('supplyledger.checkifexisting') }}",
			          			type: 'post',
			          			data: {
			          				'quantity' : quantity,
			          				'reference' : reference,
			          				'stocknumber' : stocknumber,
			          				'date': date
			          			},
			          			dataType: 'json',
			          			success:function(response){
			          				if(response == 'success')
			          				{
										createRecord(date,quantity,reference,stocknumber)
						          	} else if(response == 'duplicate')
			          				{
								        swal({
								          title: "Are you sure?",
								          text: "The record is already existing.This will duplicate the record. Do you still want to create a copy?",
								          type: "warning",
								          showCancelButton: true,
								          confirmButtonText: "Yes, duplicate it!",
								          cancelButtonText: "No, cancel it!",
								          closeOnConfirm: false,
								          closeOnCancel: false
								        },
								        function(isConfirm){
								          if (isConfirm) {
											createRecord(date,daystoconsume,quantity,reference,stocknumber)
								          } else {
								            swal("Cancelled", "Operation Cancelled", "error");
								          }
								        })
			          				} else {
			          					swal('Error occurred while processing your request','Please reload the page','error')
			          				}
			          			}
			          		})
			          } else {
			            swal("Cancelled", "Operation Cancelled", "error");
			          }
			        })
		    	})

		    	function createRecord(date,quantity,reference,stocknumber)
		    	{
            $.ajax({
					    headers: {
					        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					    },
		            	url: '{{ route("supplyledger.copy") }}',
		            	type: 'post',
		            	data: {
		            		'quantity': quantity,
		            		'reference': reference,
		            		'stocknumber': stocknumber,
		            		'date': date
		            	},
		            	dataType: 'json',
		            	success: function(response){
		            		swal('Success','','success');
		            	},
		            	 error: function(response){
		            	 	swal('Error occurred while processing your data','Please reload this page','error')
		            	 }
		            })
		    	}

				$('#page-body').show();
			} );
		</script>
@endsection
