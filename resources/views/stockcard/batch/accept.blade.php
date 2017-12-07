@extends('backpack::layout')

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">Batch Accept</h3></legend>
		<ul class="breadcrumb">
			<li><a href="{{ url('inventory/supply') }}">Supply Inventory</a></li>
			<li class="active">Batch Accept</li>
		</ul>
	</section>
@endsection

@section('content')
@include('modal.request.supply')
<!-- Default box -->
  <div class="box" style="padding:10px;">
    <div class="box-body">
		{{ Form::open(['method'=>'post','route'=>array('supply.stockcard.batch.accept'),'class'=>'form-horizontal','id'=>'acceptForm']) }}
		@if (count($errors) > 0)
		  <div class="alert alert-danger alert-dismissible" role="alert">
		       <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <ul style='margin-left: 10px;'>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
		<div class="col-sm-4">
			<div class="col-md-12">
				<div class="form-group">
					{{ Form::label('Supplier') }}
					{{ Form::select('supplier',$supplier,Input::old('supplier'),[
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
					{{ Form::text('dr',Input::old('dr'),[
						'class' => 'form-control'
					]) }}
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					{{ Form::label('Date') }}
					{{ Form::text('date',Input::old('date'),[
						'id' => 'date',
						'class' => 'form-control',
						'readonly',
						'style' => 'background-color: white;'
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
			<div class="col-md-12">
				<div class="form-group">
					{{ Form::label('Days to Consume') }}
					{{ Form::text('daystoconsume',Input::old('daystoconsume'),[
						'id' => 'daystoconsume',
						'class' => 'form-control',
					]) }}
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-12">
				{{ Form::label('stocknumber','Stock Number') }}
				</div>
				<div class="col-md-9">
				{{ Form::text('stocknumber',null,[
					'id' => 'stocknumber',
					'class' => 'form-control'
				]) }}
				</div>
				<div class="col-md-1">
					<button type="button" id="add-stocknumber" class="btn btn-sm btn-primary">Select</button>
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
						<th></th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
			<div class="pull-right">
				<div class="btn-group">
					<button type="button" id="accept" class="btn btn-md btn-primary btn-block">Accept</button>
				</div>
				<div class="btn-group">
					<button type="button" id="cancel" class="btn btn-md btn-default">Cancel</button>
				</div>
			</div>
		</div>
		{{ Form::close() }}
    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection

@section('after_scripts')
<script>
$('document').ready(function(){

	$('#purchaseorder').autocomplete({
		source: "{{ url('get/purchaseorder/all') }}"
	})

	$('#stocknumber').autocomplete({
		source: "{{ url("get/inventory/supply/stocknumber") }}"
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
	            $('#acceptForm').submit();
	          } else {
	            swal("Cancelled", "Operation Cancelled", "error");
	          }
	        })
		}

	})

	$('#cancel').on('click',function(){
		window.location.href = "{{ url('inventory/supply') }}"
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
								+ response.data.balance +
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
		if(addForm(row,stocknumber,details,quantity))
		{
			$('#stocknumber').text("")
			$('#quantity').text("")
			$('#stocknumber-details').html("")
			$('#stocknumber').val("")
			$('#quantity').val("")
		}
	})

	function addForm(row,_stocknumber = "",_info ="" ,_quantity = "")
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
				<td><input type="number" class="form-control text-center" value="` + _quantity + `" name="quantity[` + _stocknumber + `]" style="border:none;"  /></td>
				<td><button type="button" class="remove btn btn-md btn-danger text-center"><span class="glyphicon glyphicon-remove"></span></button></td>
			</tr>
		`)

		return true;
	}

	$('#date').on('change',function(){
		setDate("#date");
	});

	$('#cancel').on('click',function(){
		window.location.href = "{{ url('inventory/supply') }}"
	})

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

		addForm(row,"{{ $stocknumber }}","{{ old("info.$stocknumber") }}", "{{ old("quantity.$stocknumber") }}")
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

    $('#stocknumber').on('change',function(){
      setStockNumberDetails()
    })

    $('#add-stocknumber').on('click',function(){
      $('#addStockNumberModal').modal('show');
    })

    $('#supplyInventoryTable').on('click','.add-stock',function(){
      $('#stocknumber').val($(this).data('id'))
      $('#addStockNumberModal').modal('hide')
      setStockNumberDetails()
    })
})
</script>
@endsection
