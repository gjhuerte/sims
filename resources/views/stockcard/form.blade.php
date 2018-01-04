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
	<div class="form-group">
		<div class="col-md-12">
			{{ Form::label('Requisition Issuance Slip') }}
		</div>
		<div class="col-md-8">
			{{ Form::text('reference',Input::old('reference'),[
				'id' => 'reference',
				'class' => 'form-control'
			]) }}
		</div>
		<div class="col-md-3">
			<button type="button" id="generateRIS" class="btn btn-md btn-primary" onclick=" $.ajax({ type: 'get', url: '{{ url('request/generate') }}', dataType: 'json', success: function(response){ $('#reference').val(response) } }) ">Generate</button>
		</div>
	</div>
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
	<div class="col-md-12">
		<div class="form-group">
			{{ Form::label('Fund Clusters') }}
			{{ Form::text('fundcluster',Input::old('fundcluster'),[
				'class' => 'form-control'
			]) }}
			<p class="text-muted">Separate each cluster by comma</p>
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-12">
		{{ Form::label('stocknumber','Stock Number') }}
		</div>
		<div class="col-md-9">
		{{ Form::text('stocknumber',null,[
			'id' => 'stocknumber',
			'class' => 'form-control',
			'onchange' => 'setStockNumberDetails()'
		]) }}
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
	            $('#stockCardForm').submit();
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
					$('#supply-item').val(details.toString())
					$('#stocknumber-details').html(`
						<div class="alert alert-info">
							<ul class="list-unstyled">
								<li><strong>Item:</strong> ` + details + ` </li>
								<li><strong>Remaining Balance:</strong> `
								+ response.data.stock_balance +
								`</li>
							</ul>
						</div>
					`)

					$('#add').show()
				} catch (e) {
					$('#stocknumber-details').html(`
						<div class="alert alert-danger">
							<ul class="list-unstyled">
								<li>Invalid Property Number</li>
							</ul>
						</div>
					`)

					$('#add').hide()
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
		daystoconsume = $('#daystoconsume').val()
		if(addForm(row,stocknumber,details,quantity,daystoconsume))
		{
			$('#stocknumber').val("")
			$('#quantity').val("")
			$('#daystoconsume').val("")
			$('#stocknumber-details').html("")
		}
	})

	function addForm(row,_stocknumber = "",_info ="" ,_quantity = "", _daystoconsume = "")
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

		addForm(row,"{{ $stocknumber }}","{{ old("info.$stocknumber") }}", "{{ old("quantity.$stocknumber") }}", "{{ old("daystoconsume.$stocknumber") }}")
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
})
</script>