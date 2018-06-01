
@if($title == 'Accept')

<!-- suppliers -->
<div class="row">
	<!-- supplier form -->
	<div class="col-md-12">
		<div class="col-md-12">
			<div class="form-group">
				{{ Form::label('Supplier') }}
				{{ Form::select('supplier', (isset($supplier) && count($supplier) > 0) ? $supplier : [], old('supplier'),[
					'id' => 'supplier',
					'class' => 'form-control'
				]) }}
			</div>
		</div>
	</div> <!-- end of supplier form -->
</div> <!-- suppliers -->

<!-- references and receipts -->

<hr style="color: black; background-color :black;" />

<div class="row">

	<div class="col-sm-12">
		<div class="col-sm-12 form-group">
			<input type="checkbox" id="physical" name="physical" /> Physical Inventory
		</div>
	</div>

	<!-- receipt form -->
	<div class="col-sm-6" id="receipt-form">
		<div class="panel panel-default">
			<div class="panel-heading" style="border-radius: 0px;">
				<h4 class="text-muted"><strong> Delivery Receipt / Invoice </strong> </h4>
			</div>
			<div class="panel-body">
				
				<!-- top -->
				<div class="form-group">
					<div class="col-sm-6">
						{{ Form::label('D.R. No.: ') }}
						{{ Form::text('receipt', old('receipt'),[
							'id' => 'receipt',
							'class' => 'form-control',
							'placeholder' => 'D.R. Number'
						]) }}
						<div id="receipt-details"></div>
					</div>

					<div class="col-sm-6">
						{{ Form::label('Invoice No.: ') }}
						{{ Form::text('invoice', old('invoice'),[
							'id' => 'invoice',
							'class' => 'form-control',
							'placeholder' => 'Invoice Number'
						]) }}
					</div>
				</div> <!-- top -->

				<!-- bottom -->
				<div class="form-group">
					<!-- receipt date -->
					<div class="col-sm-6">
						{{ Form::label('D.R. Date') }}
						{{ Form::text('receipt-date', old('receipt-date'),[
							'id' => 'receipt-date',
							'class' => 'form-control',
							'readonly',
							'style' => 'background-color: white;',
							'placeholder' => 'D.R.  Date'
						]) }}
					</div> <!-- end of receipt date -->

					<!-- invoice date -->
					<div class="col-sm-6">
						{{ Form::label('Invoice Date') }}
						{{ Form::text('invoice-date', old('invoice-date'),[
							'id' => 'invoice-date',
							'class' => 'form-control',
							'readonly',
							'style' => 'background-color: white;',
							'placeholder' => 'Invoice Date'
						]) }}
					</div> <!-- end of invoice date -->
				</div> <!-- bottom -->

			</div>
		</div>
	</div> <!-- end of receipt form -->

	<!-- purchase order form -->
	<div class="col-sm-6" id="reference-form">
		<div class="panel panel-default">
			<div class="panel-heading" style="border-radius: 0px;">
				<h4 class="text-muted"><strong>Purchase Order / Agency Purchase Request </strong> </h4>
			</div>
			<div class="panel-body">

				<!-- purchase order number -->
				<div class="col-md-12">
					<div class="form-group">
						{{ Form::label('purchaseorder','P.O. No.:',[
								'id' => 'purchaseorder-label'
						]) }}
						{{ Form::text('purchaseorder',Input::old('purchaseorder'),[
							'id' => 'purchaseorder',
							'class' => 'form-control',
							'placeholder' => 'P.O. Number'
						]) }}
					</div>
					<div id="purchaseorder-details"></div>
					<div class="clearfix"></div>
				</div> <!-- end of purchase order number -->

				<!-- purchase order date -->
				<div class="col-md-12">
					<div class="form-group">
						{{ Form::label('Date') }}
						{{ Form::text('date', old('date'),[
							'id' => 'date',
							'class' => 'form-control',
							'readonly',
							'style' => 'background-color: white;',
							'placeholder' => 'P.O. Date'
						]) }}
					</div>
				</div> <!-- end of purchase order date -->

			</div>
		</div>
	</div> <!-- end of purchase order form -->

</div> <!-- references and receipts -->

<hr style="color: black; background-color :black;" />

@endif

<!-- supplies list -->
<div class="row">
	<div class="col-sm-4">
		{{-- released form --}}
		@if($title == 'Release')

		<!-- date released -->
		<div class="col-md-12">
			<div class="form-group">
				{{ Form::label('Date') }}
				{{ Form::text('date', old('date'),[
					'id' => 'date',
					'class' => 'form-control',
					'readonly',
					'style' => 'background-color: white;',
				]) }}
			</div>
		</div> <!-- date released-->

		<!-- office -->
		<div class="col-md-12">
			<div class="form-group">
				{{ Form::label('Office') }}
				{{ Form::text('office',Input::old('office'),[
					'id' => 'office',
					'class' => 'form-control'
				]) }}
			</div>
		</div> <!-- office -->

		<!-- office details -->
		<div id="office-details"></div> 
		<!-- office details -->

		{{-- inner released --}}
		@if($title == 'Release')

		<!-- ris form -->
		<div class="form-group">
			<div class="col-md-12">
				{{ Form::label('Requisition Issuance Slip') }}
			</div>
			<div class="@if($type == 'ledger' && $title == 'Release') col-md-12 @else col-md-8 @endif">
				{{ Form::text('reference',Input::old('reference'),[
					'id' => 'reference',
					'class' => 'form-control'
				]) }}
			</div>

			@if($type == 'stock')
			<div class="col-md-3">
				<button type="button" id="generateRIS" class="btn btn-md btn-primary" onclick=" ">Generate</button>
			</div>

			<script>
				$(document).ready(function(){
					$('#generateRIS').on('click', function(){
						$.ajax({  
							headers: { 
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
							}, 
							type: 'get', 
							url: '{{ url('request/generate') }}', 
							dataType: 'json', 
							success: function(response){ 
								$('#reference').val(response) 
							} 
						}) 
					})
				})
			</script>
			@endif
		</div> <!-- ris form -->

		@endif
		{{-- inner released --}}

		@endif 
		{{-- end of released form --}}

		@if($title == 'Accept')

		@if($type == 'ledger')
		<div class="col-md-12">
			<div class="form-group">
				{{ Form::label('Fund Clusters') }}
				<br /> Suggestions:
				@foreach(App\FundCluster::whereNotIn('code', [' '])->whereNotNull('code')->take('5')->pluck('code') as $fundcluster)
				<button type="button" value="{{ $fundcluster }}" class="btn btn-default fundcluster-item" style="margin-bottom: 10px;"> 
					{{ $fundcluster }} 
				</button>
				@endforeach
				{{ Form::text('fundcluster',Input::old('fundcluster'),[
					'id' => 'fundcluster',
					'class' => 'form-control',
					'placeholder' => 'Input the list of Fund Code here and separate it by comma'
				]) }}
				<p class="text-muted">Separate each cluster by comma</p>
			</div>
		</div>
		@endif

		@endif

		<div class="form-group">
			<div class="col-md-12">
			{{ Form::label('stocknumber','Stock Number') }}
			</div>
			<div class="col-md-9">
			<input type="text" value="" id="stocknumber" class="form-control" />
			</div>
			<div class="col-md-1">
				<button type="button" data-toggle="modal" data-target="#addStockNumberModal" class="btn btn-sm btn-primary">Search</button>
			</div>
		</div>

		<!-- supply details -->
		<input type="hidden" id="supply-item" />
		<div id="stocknumber-details"></div>
		<!-- supply details -->

		<!-- quantity -->
		<div class="col-md-12">
			<div class="form-group">
			{{ Form::label('Quantity') }}
			{{ Form::text('quantity','',[
				'id' => 'quantity',
				'class' => 'form-control'
			]) }}
			</div>
		</div> <!-- quantity -->

		@if($type == 'ledger')

		@if($title == 'Release')

		@if(false)
		<div class="col-md-12">
			<div class="form-group">
			{{ Form::label('Computation Type:') }}
			<input type="radio" id="fifo" name="computation_type" value="fifo" /> FIFO (First In First Out)
			<input type="radio" id="averaging" name="computation_type" value="averaging" checked/> Averaging
			</div>
		</div>
		@endif

		@endif

		<div class="form-group">
			<div class="col-md-12">
			{{ Form::label('Unit Price') }}
			</div>
			<div class="@if($type == 'ledger' && $title == 'Release') col-md-9 @else col-md-12 @endif">
			{{ Form::text('unitcost','',[
				'id' => 'unitcost',
				'class' => 'form-control'
			]) }}
			</div>

			@if($title == 'Release')
			<div class="col-md-1">
				<button type="button" id="compute" class="btn btn-sm btn-warning">Compute</button>
			</div>
			<div class="col-md-12">
				<p style="font-size:12px;">
					Click the button beside the field to generate price. 
					<br /><span class="text-danger">Note:</span> The Stock Number and Quantity fields must have value before generating Unit Cost</p>
			</div>
			@endif

		</div>

		@endif

		@if($title == 'Release')
		<div class="col-md-12">
			<div class="form-group">
				{{ Form::label('Days to Consume') }}
				{{ Form::text('daystoconsume',Input::old('daystoconsume'),[
					'id' => 'daystoconsume',
					'class' => 'form-control',
				]) }}
			</div>
		</div>
		@endif

		<div class="btn-group" style="margin-bottom: 20px;">
			<button type="button" id="add" class="btn btn-md btn-success"><span class="glyphicon glyphicon-plus"></span> Add</button>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="text-muted">Supplies List</h3>
			</div>

			<div class="panel-body">
				<div class="clearfix"></div>

				<div class="col-sm-12">
					<button type="button" id="reset" class="btn btn-md pull-right" style="color: #9D2933; background-color: #ECF0F1; border-color: #e5e5e5; margin-bottom: 10px;">Clear All</button>
				</div>


				<table class="table table-hover table-condensed table-bordered" id="supplyTable">
					<thead>
						<tr>
							<th>Stock Number</th>
							<th>Information</th>
							<th>Quantity</th>

							@if($type == 'ledger')
							<th>Unit Cost</th>
							@endif

							@if($title == 'Release')
							<th>Days To Consume</th>
							@endif
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="text-center text-muted" colspan="@if($type == 'ledger') 5 @if($title == 'Release') 6 @else 5 @endif  @else 4 @endif">*** Nothing Follows ***</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div> <!-- supplies list -->

<!-- buttons -->
<div class="row box-footer">
	<div class="col-sm-12">
		<div class="pull-right">
			<div class="btn-group">
				<button type="button" id="accept" class="btn btn-md btn-primary btn-block" data-loading-text="Submitting..." autocomplete="off">{{ $title }}</button>
			</div>
			<div class="btn-group">
				<button type="button" id="cancel" class="btn btn-md btn-default" onclick='window.location.href = "{{ url('inventory/supply') }}"'>Cancel</button>
			</div>
		</div>
	</div>
</div> <!-- buttons -->

<script>
$('document').ready(function(){

	$('#physical').on('change', function(){
		if($('#physical').prop('checked')){
			$('#receipt-form').hide(400)
			$('#reference-form').hide(400)
		}else{
			$('#receipt-form').show(400)
			$('#reference-form').show(400)
		}
	})

	jQuery.fn.extend({
	  setDate: function(obj){
			var object = $(this);

			if(obj == null)
				var date = moment().format('MMM DD, YYYY');
			else
				var date = moment(obj).format('MMM DD, YYYY');

			object.val(date);
		}
	});

	$('#reset').on('click', function(){
		$('#supplyTable > tbody').html(`
				<tr>
					<td class="text-center text-muted" colspan="@if($type == 'ledger') 5 @if($title == 'Release') 6 @else 5 @endif  @else 4 @endif">*** Nothing Follows ***</td>
				</tr>
		`)
	})

	$('#purchaseorder').autocomplete({
		source: "{{ url('get/purchaseorder/all') }}"
	})

	$('#receipt').autocomplete({
		source: "{{ url('get/receipt/all') }}"
	})

	$('#stocknumber').autocomplete({
		source: "{{ url("get/inventory/supply/stocknumber") }}"
	})

	$('#stocknumber').on('click focus-in mousein keyup focus-out', function(){
		setStockNumberDetails()
	})

	$('#office').autocomplete({
		source: "{{ url('get/office/code') }}"
	})

	$('#purchaseorder').on('change mousein keyup focusin', function(){
		$.ajax({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
			type: 'get',
			url: '{{ url('purchaseorder') }}' +  '/' + $('#purchaseorder').val() + '?number=' + $('#purchaseorder').val()  ,
			dataType: 'json',
			success: function(response){
				if(response.number)
				{
					$('#purchaseorder-details').html(`
						<p class="text-success"><strong>Exists! </strong> Purchase Order Found </p>
					`)
					$('#fundcluster').val(response.fundcluster)
				}else{
					$('#purchaseorder-details').html(`
						<p class="text-danger"><strong>Error! </strong> Purchase Order Details not found! Creating new Purchase Order </p>
					`)
				}
			}
		})
	})

	$('#receipt').on('focusout', function(){
		receipt = $('#receipt').val()
		$.ajax({
			type: 'get',
			url: '{{ url('receipt') }}' +  '/' + receipt ,
			data: {
				'type': 'exists',
				'number': receipt
			},
			dataType: 'json',
			success: function(response){
				if( response != null && response.receipt.number )
				{

					swal('Wait!', 'Fetching records from the server...')

					invoice = response.receipt.invoice
					invoice_date = response.receipt.invoice_date
					date_delivered = response.receipt.date_delivered
					date = response.receipt.purchaseorder.date_received
					purchaseorder = response.receipt.purchaseorder.number
					fundcluster = response.fundcluster

					$('#supplyTable > tbody').html(`
							<tr>
								<td class="text-center text-muted" colspan="@if($type == 'ledger') 5 @if($title == 'Release') 6 @else 5 @endif  @else 4 @endif">*** Nothing Follows ***</td>
							</tr>
					`)

					response.supplies.forEach(function(callback){
						addForm(callback.stocknumber, callback.details, callback.pivot.quantity)
					})

					$('#fundcluster').val('')

					fundcluster.forEach(function(callback){
						val = $('#fundcluster').val()
						$('#fundcluster').val(val + callback + ', ')
					})

					$('#invoice').val(invoice)
					$('#invoice-date').setDate(invoice_date)
					$('#date').setDate(date)
					$('#dr-date').setDate(date_delivered)
					$('#purchaseorder').val(purchaseorder)

					$('#receipt-details').html(`
						<p class="text-success"><strong>Exists! </strong> Receipt Found </p>
					`)

					swal('Success!', 'Field information has been updated!', 'success')
				}
				else{
					$('#receipt-details').html(`
						<p class="text-danger"><strong>Warning! </strong> Receipt Details not found! This will create a new receipt </p>
					`)
				}
			}
		})
	})
 
	$('#office').on('change mousein keyup focusin',function(){
		$.ajax({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
			type: 'get',
			url: '{{ url('maintenance/office') }}' +  '/' + $('#office').val() + '?code=' + $('#office').val()  ,
			dataType: 'json',
			success: function(response){
				try{
					if(response.data.name)
					{
						$('#office-details').html(`
							<p class="text-success"><strong>Office: </strong> ` + response.data.name + ` </p>
						`)
					}
					else
					{
						$('#office-details').html(`
							<p class="text-danger"><strong>Error! </strong> Office not found </p>
						`)
					}
				} catch (e) {
					$('#office-details').html(`
						<p class="text-danger"><strong>Error! </strong> Office not found </p>
					`)
				}
			}
		})
	})

	$('#accept').on('click',function(){
		if($('#supplyTable > tbody > tr').length == 0)
		{
			swal('Blank Field Notice!','Supply table must have atleast 1 item','error')
		} else {
        	swal({
	          title: "Are you sure?",
	          text: "This will no longer be editable once submitted. Do you want to continue?",
	          type: "warning",
	          showCancelButton: true,
	          confirmButtonText: "Yes, submit it!",
	          cancelButtonText: "No, cancel it!",
	          closeOnConfirm: false,
	          closeOnCancel: false
	        },
	        function(isConfirm){
	          if (isConfirm) {
	          	@if($type == 'ledger')
	            $('#ledgerCardForm').submit();
	          	@else
	            $('#stockCardForm').submit();
	            @endif
	          } else {
	            swal("Cancelled", "Operation Cancelled", "error");
	          }
	        })
		}

	})

	function setStockNumberDetails(){
		$.ajax({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
			type: 'get',
			url: '{{ url('inventory/supply') }}' +  '/' + $('#stocknumber').val(),
			dataType: 'json',
			success: function(response){
				try{
					details = response.data.details
					unit = response.data.unit_name
					@if($type == 'ledger')
					balance = response.data.ledger_balance
					@else
					balance = response.data.stock_balance
					@endif
					$('#supply-item').val(details.toString())
					$('#stocknumber-details').html(`
						<div class="alert alert-success">
							<ul class="list-unstyled">
								<li><strong>Item:</strong> ` + details + ` </li>
								<li><strong>Unit:</strong> <span class="label label-warning">` + unit + `</span> </li>
								<li><strong>Remaining Balance:</strong> `
								+ balance +
								`</li>
							</ul>
						</div>
					`)

					url = "{{ url('inventory/supply')  }}" +  '/' + $('#stocknumber').val() + '/compute/daystoconsume'

					$.getJSON( url, function( data ) {
					  $('#daystoconsume').val(data)
					});
					    				
				} catch (e) {
					$('#stocknumber-details').html(`
						<div class="alert alert-danger">
							<ul class="list-unstyled">
								<li>Invalid Property Number</li>
							</ul>
						</div>
					`)

				}
			}
		})
	}

	$( "#date" ).datepicker({
		  changeMonth: true,
		  changeYear: true,
		  maxAge: 59,
		  minAge: 15,
	});

	$( "#invoice-date" ).datepicker({
		  changeMonth: true,
		  changeYear: true,
		  maxAge: 59,
		  minAge: 15,
	});

	$( "#receipt-date" ).datepicker({
		  changeMonth: true,
		  changeYear: true,
		  maxAge: 59,
		  minAge: 15,
	});

	@if(Input::old('date'))
		$('#date').setDate('{{ Input::old('date') }}');
	@else
		$('#date').setDate('{{ Carbon\Carbon::now()->toFormattedDateString() }}');
	@endif

	@if(Input::old('invoice-date'))
		$('#invoice-date').setDate('{{ Input::old('invoice-date') }}');
	@else
		$('#invoice-date').setDate('{{ Carbon\Carbon::now()->toFormattedDateString() }}');
	@endif

	@if(Input::old('receipt-date'))
		$('#receipt-date').setDate('{{ Input::old('receipt-date') }}');
	@else
		$('#receipt-date').setDate('{{ Carbon\Carbon::now()->toFormattedDateString() }}');
	@endif

	$('#invoice-date, #date, #receipt-date').on('change', function(){
		$(this).setDate( $(this).val() )
	})

	$('#add').on('click',function(){
		row = parseInt($('#supplyTable > tbody > tr:last').text())

		stocknumber = $('#stocknumber').val()
		quantity = $('#quantity').val()
		details = $('#supply-item').val()

		@if($type == 'ledger')
		unitcost = $('#unitcost').val()
		@endif
		daystoconsume = $('#daystoconsume').val()
		if(addForm(stocknumber,details,quantity,daystoconsume @if($type == 'ledger'), unitcost @endif))
		{
			$('#stocknumber').val("")
			$('#quantity').val("")

			@if($title == 'Release')
			$('#daystoconsume').val("")
			@endif

			@if($type == 'ledger')
			$('#unitcost').val("")
			@endif

			$('#stocknumber-details').html("")
		}
	})

	function addForm(_stocknumber = "",_info ="" ,_quantity = "", _daystoconsume = "" @if($type == 'ledger'), _unitcost = 0 @endif)
	{
		error = false
		$('.stocknumber-list').each(function() {
		    if (_stocknumber == $(this).val())
		    {
		    	error = true;	
		    	return;
		    }
		});

		if(error)
		{
			swal("Error", "Stocknumber already exists", "error");
			return false;
		}

		$('#supplyTable > tbody').prepend(`
			<tr>
				<td><input type="text" class="stocknumber-list form-control text-center" value="` + _stocknumber + `" name="stocknumber[` + _stocknumber + `]" style="border:none;" /></td>
				<td><input type="hidden" class="form-control text-center" value="` + _info + `" name="info[` + _stocknumber + `]" style="border:none;" />` + _info + `</td>
				<td>
					<input type="number" class="form-control text-center" value="` + _quantity + `" name="quantity[` + _stocknumber + `]" style="border:none;"  />
				</td>

				@if($type == 'ledger')
				<td>
					<input type="text" class="form-control text-center" value="` + _unitcost + `" name="unitcost[` + _stocknumber + `]" style="border:none;"  />
				</td>
				@endif

				@if($title == 'Release')
				<td>
					<input type="text" class="form-control text-center" value="` + _daystoconsume + `" name="daystoconsume[` + _stocknumber + `]" style="border:none;"  />
				</td>
				@endif

				<td>
					<button type="button" class="remove btn btn-md btn-danger text-center"><span class="glyphicon glyphicon-remove"></span></button>
				</td>
			</tr>
		`)

		return true;
	}

	$('#supplyTable').on('click','.remove',function(){
		$(this).parents('tr').remove()
	})

	@if(null !== old('stocknumber'))

	function init()
	{

		@foreach(old('stocknumber') as $stocknumber)

		addForm("{{ $stocknumber }}","{{ old("info.$stocknumber") }}", "{{ old("quantity.$stocknumber") }}", "{{ old("daystoconsume.$stocknumber") }}" @if($type == 'ledger') , "{{ old("unitcost.$stocknumber") }}" @endif)
		@endforeach

	}

	init();

	@endif

	setReferenceLabel( $("#supplier option:selected").text() )

	$('#supplier').on('change',function(){
		setReferenceLabel($("#supplier option:selected").text())
	})

    function setReferenceLabel(supplier)
    {
      	if( supplier == "{{ config('app.main_agency') }}")
      	{
      		$('#purchaseorder-label').text('A.P.R. No.:')
      	}
      	else
      	{
      		$('#purchaseorder-label').text('P.O. No.:')
      	}
    }

    $('#stocknumber').on('change focusin focusout mousein keyup', function(){
    	setStockNumberDetails()
    })

    $('#supplyInventoryTable').on('click','.add-stock',function(){
      $('#stocknumber').val($(this).data('id'))
      $('#addStockNumberModal').modal('hide')
      setStockNumberDetails()
    })

    $('#compute').on('click',function(){
    	type = "undefined"
    	stocknumber = $('#stocknumber').val()
    	quantity = $('#quantity').val()

    	if($('#fifo').is(':checked'))
    	{
    		type = "fifo"
    	}

    	if($('#averaging').is(":checked"))
    	{
    		type = "averaging"
    	}

		$.ajax({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
			type: 'get',
			url: '{{ url('inventory/supply/ledgercard') }}' +  '/' + type  + '/computecost' ,
			dataType: 'json',
			data:{
				'quantity' : quantity,
				'stocknumber' : stocknumber
			},
			success: function(response){
				$('#unitcost').val(response);
			}
		})
    })

    $('#fundcluster').on('change', function(){
    	e.preventDefault()
    })

    $('.fundcluster-item').on('click', function(){
    	text =  $(this).val()
    	f_text = $('#fundcluster').val()


    	if(f_text.length <= 1 )
    		text = text
    	else
    		text = f_text.toString() + "," + text.toString()
    	$('#fundcluster').val(text) 
    })
})
</script>