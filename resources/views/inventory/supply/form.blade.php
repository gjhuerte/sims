<div class="col-sm-4">
	@if($title == 'Release')
	<div class="col-md-12">
		<div class="form-group">
			{{ Form::label('Office') }}
			{{ Form::text('office',Input::old('office'),[
				'id' => 'office',
				'class' => 'form-control'
			]) }}
		</div>
	</div>
	<div id="office-details"></div>

	@if($title == 'Release')
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
			<button type="button" id="generateRIS" class="btn btn-md btn-primary" onclick=" $.ajax({ type: 'get', url: '{{ url('request/generate') }}', dataType: 'json', success: function(response){ $('#reference').val(response) } }) ">Generate</button>
		</div>
		@endif
	</div>
	@endif

	@endif
	@if($title == 'Accept')
	<div class="col-md-12">
		<div class="form-group">
			{{ Form::label('Supplier') }}
			{{ Form::select('supplier', (isset($supplier) && count($supplier) > 0) ? $supplier : [], old('supplier'),[
				'id' => 'supplier',
				'class' => 'form-control'
			]) }}
		</div>
	</div>
	<div class="col-md-12" style="margin-top:10px;">
		<div class="form-group">
			{{ Form::label('purchaseorder','Purchase Order',[
					'id' => 'purchaseorder-label'
			]) }}
			{{ Form::text('purchaseorder',Input::old('purchaseorder'),[
				'id' => 'purchaseorder',
				'class' => 'form-control'
			]) }}
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			{{ Form::label('Delivery Receipt') }}
			{{ Form::text('receipt', old('receipt'),[
				'class' => 'form-control'
			]) }}
		</div>
	</div>

	@if($type == 'ledger')
	<div class="col-md-12">
		<div class="form-group">
			{{ Form::label('Invoice Number') }}
			{{ Form::text('invoice',Input::old('invoice'),[
				'class' => 'form-control'
			]) }}
		</div>
	</div>
	@endif

	@endif
	<div class="col-md-12">
		<div class="form-group">
			{{ Form::label('Date') }}
			{{ Form::text('date', old('date'),[
				'id' => 'date',
				'class' => 'form-control',
				'readonly',
				'style' => 'background-color: white;',
				'onchange' => 'setDate("#date");'
			]) }}
		</div>
	</div>

	@if($title == 'Accept')
	<div class="col-md-12">
		<div class="form-group">
			{{ Form::label('Fund Clusters') }}
			{{ Form::text('fundcluster',Input::old('fundcluster'),[
				'class' => 'form-control'
			]) }}
			<p class="text-muted">Separate each cluster by comma</p>
		</div>
	</div>
	@endif

	<div class="form-group">
		<div class="col-md-12">
		{{ Form::label('stocknumber','Stock Number') }}
		</div>
		<div class="col-md-9">
		<input type="text" value="" name="stocknumber" id="stocknumber" class="form-control" />
		</div>
		<div class="col-md-1">
			<button type="button" data-toggle="modal" data-target="#addStockNumberModal" class="btn btn-sm btn-primary">Select</button>
		</div>
	</div>
	<input type="hidden" id="supply-item" />
	<div id="stocknumber-details">
	</div>
	<div class="col-md-12">
		<div class="form-group">
		{{ Form::label('Quantity') }}
		{{ Form::text('quantity','',[
			'id' => 'quantity',
			'class' => 'form-control'
		]) }}
		</div>
	</div>

	@if($type == 'ledger')

	@if($title == 'Release')
	<div class="col-md-12">
		<div class="form-group">
		{{ Form::label('Computation Type:') }}
		<input type="radio" id="fifo" name="computation_type" value="fifo" /> FIFO (First In First Out)
		<input type="radio" id="averaging" name="computation_type" value="averaging" checked/> Averaging
		</div>
	</div>
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

	<div class="col-md-12">
		<div class="form-group">
			{{ Form::label('Days to Consume') }}
			{{ Form::text('daystoconsume',Input::old('daystoconsume'),[
				'id' => 'daystoconsume',
				'class' => 'form-control',
			]) }}
		</div>
	</div>

	<div class="btn-group" style="margin-bottom: 20px;">
		<button type="button" id="add" class="btn btn-md btn-success"><span class="glyphicon glyphicon-plus"></span> Add</button>
	</div>
</div>
<div class="col-sm-8">
	<legend class="text-muted"><h3>Supplies List</h3></legend>
	<table class="table table-hover table-condensed table-bordered" id="supplyTable">
		<thead>
			<tr>
				<th>Stock Number</th>
				<th>Information</th>
				<th>Quantity</th>

				@if($type == 'ledger')
				<th>Unit Cost</th>
				@endif

				<th>Days To Consume</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
<div class="col-sm-12">
	<div class="pull-right">
		<div class="btn-group">
			<button type="button" id="accept" class="btn btn-md btn-primary btn-block">{{ $title }}</button>
		</div>
		<div class="btn-group">
			<button type="button" id="cancel" class="btn btn-md btn-default" onclick='window.location.href = "{{ url('inventory/supply') }}"'>Cancel</button>
		</div>
	</div>
</div>
<script>
$('document').ready(function(){

	$('#purchaseorder').autocomplete({
		source: "{{ url('get/purchaseorder/all') }}"
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

	$('#office').on('change',function(){
		$.ajax({
			type: 'get',
			url: '{{ url('maintenance/office') }}' +  '/' + $('#office').val() ,
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
			type: 'get',
			url: '{{ url('inventory/supply') }}' +  '/' + $('#stocknumber').val(),
			dataType: 'json',
			success: function(response){
				try{
					details = response.data.details
					@if($type == 'ledger')
					balance = response.data.ledger_balance
					@else
					balance = response.data.stock_balance
					@endif
					$('#supply-item').val(details.toString())
					$('#stocknumber-details').html(`
						<div class="alert alert-info">
							<ul class="list-unstyled">
								<li><strong>Item:</strong> ` + details + ` </li>
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

	@if(Input::old('date'))
		$('#date').val('{{ Input::old('date') }}');
		setDate("#date");
	@else
		$('#date').val('{{ Carbon\Carbon::now()->toFormattedDateString() }}');
		setDate("#date");
	@endif

	$('#add').on('click',function(){
		row = parseInt($('#supplyTable > tbody > tr:last').text())
		if(isNaN(row))
		{
			row = 1
		} else row++

		stocknumber = $('#stocknumber').val()
		quantity = $('#quantity').val()
		details = $('#supply-item').val()

		@if($type == 'ledger')
		unitcost = $('#unitcost').val()
		@endif
		daystoconsume = $('#daystoconsume').val()
		if(addForm(row,stocknumber,details,quantity,daystoconsume @if($type == 'ledger'), unitcost @endif))
		{
			$('#stocknumber').val("")
			$('#quantity').val("")
			$('#daystoconsume').val("")

			@if($type == 'ledger')
			$('#unitcost').val("")
			@endif
			$('#stocknumber-details').html("")
		}
	})

	function addForm(row,_stocknumber = "",_info ="" ,_quantity = "", _daystoconsume = "" @if($type == 'ledger'), _unitcost = '' @endif)
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

		$('#supplyTable > tbody').append(`
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

				<td>
					<input type="text" class="form-control text-center" value="` + _daystoconsume + `" name="daystoconsume[` + _stocknumber + `]" style="border:none;"  />
				</td>
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

	function setDate(object){
			var object_val = $(object).val()
			var date = moment(object_val).format('MMM DD, YYYY');
			$(object).val(date);
	}

	@if(null !== old('stocknumber'))

	function init()
	{

		@foreach(old('stocknumber') as $stocknumber)
		row = parseInt($('#supplyTable > tbody > tr:last').text())
		if(isNaN(row))
		{
		  row = 1
		} else row++

		addForm(row,"{{ $stocknumber }}","{{ old("info.$stocknumber") }}", "{{ old("quantity.$stocknumber") }}", "{{ old("daystoconsume.$stocknumber") }}" @if($type == 'ledger') , "{{ old("unitcost.$stocknumber") }}" @endif)
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
      		$('#purchaseorder-label').text('Agency Purchase Request')
      	}
      	else
      	{
      		$('#purchaseorder-label').text('Purchase Order')
      	}
    }

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
})
</script>