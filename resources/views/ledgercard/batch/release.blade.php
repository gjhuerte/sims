@extends('backpack::layout')

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">Batch Release</h3></legend>
		<ul class="breadcrumb">
			<li><a href="{{ url('inventory/supply') }}">Supply Inventory</a></li>
			<li class="active">Batch Release</li>
		</ul>
	</section>
@endsection

@section('content')
@include('modal.request.supply')
<!-- Default box -->
  <div class="box" style="padding:10px;">
    <div class="box-body">
		{{ Form::open(['method'=>'post','route'=>array('supply.ledgercard.batch.release'),'class'=>'form-horizontal','id'=>'releaseForm']) }}
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
        <div class="col-md-6">
			<div class="col-md-12">
				<div class="form-group">
					{{ Form::label('Requisition Issuance Slip') }}
					{{ Form::text('reference',Input::old('reference'),[
						'class' => 'form-control'
					]) }}
				</div>
			</div>
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
			<div class="col-md-12">
				<div class="form-group">
				{{ Form::label('Computation Type:') }}
				<input type="radio" id="fifo" name="computation_type" value="fifo" /> FIFO (First In First Out)
				<input type="radio" id="averaging" name="computation_type" value="averaging" checked/> Averaging
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-12">
				{{ Form::label('Unit Cost') }}
				</div>
				<div class="col-md-9">
				{{ Form::text('unitprice','',[
					'id' => 'unitprice',
					'class' => 'form-control',
					'readonly',
					'style' => 'background-color:white;'
				]) }}
				</div>
				<div class="col-md-1">
					<button type="button" id="compute" class="btn btn-sm btn-primary">Compute</button>
				</div>
				<div class="col-md-12">
					<p style="font-size:12px;">
						Click the button beside the field to generate price. 
						<br /><span class="text-danger">Note:</span> The Stock Number and Quantity fields must have value before generating Unit Cost</p>
				</div>
			</div>
			<div class="btn-group" style="margin-bottom: 20px">
				<button type="button" id="add" class="btn btn-md btn-success"><span class="glyphicon glyphicon-plus"></span> Add</button>
			</div>
		</div>
		<div class="col-md-6">
			<legend>Supplies List</legend>
			<table class="table table-hover table-condensed table-bordered" id="supplyTable">
				<thead>
					<tr>
						<th>Stock Number</th>
						<th>Information</th>
						<th>Quantity</th>
						<th>Unit Cost</th>
						<th></th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
			<div class="pull-right">
				<div class="btn-group">
					<button type="button" id="release" class="btn btn-md btn-primary btn-block">Release</button>
				</div>
				<div class="btn-group">
					<button type="button" id="cancel" class="btn btn-md btn-default">Cancel</button>
				</div>
			</div>
			{{ Form::close() }}
		</div>
    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection

@section('after_scripts')
<script>
$('document').ready(function(){

	$('#stocknumber').autocomplete({
		source: "{{ url("get/inventory/supply/stocknumber") }}"
	})

	$('#office').autocomplete({
		source: "{{ url('get/office/code') }}"
	})

	$('#release').on('click',function(){
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
	            $('#releaseForm').submit();
	          } else {
	            swal("Cancelled", "Operation Cancelled", "error");
	          }
	        })
		}
	})

	$('#cancel').on('click',function(){
		window.location.href = "{{ url('inventory/supply') }}"
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
								+ response.data.ledger_balance +
								`</li>
							</ul>
						</div>
					`)

					$('#unitprice').val("");
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
		  changeYear: false,
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
		unitprice = $('#unitprice').val()
		addForm(row,stocknumber,details,quantity,unitprice)
		$('#stocknumber').text("")
		$('#quantity').text("")
		$('#unitprice').text("")
		$('#stocknumber-details').html("")
		$('#stocknumber').val("")
		$('#quantity').val("")
		$('#text').val("")
		$('#add').hide()
	})

	function addForm(row,_stocknumber = "",_info ="" ,_quantity = "",_unitprice = 0)
	{
		$('#supplyTable > tbody').append(`
			<tr>
				<td><input type="text" class="form-control text-center" value="` + _stocknumber + `" name="stocknumber[` + _stocknumber + `]" style="border:none;" /></td>
				<td><input type="hidden" class="form-control text-center" value="` + _info + `" name="info[` + _stocknumber + `]" style="border:none;" />` + _info + `</td>
				<td><input type="number" class="form-control text-center" value="` + _quantity + `" name="quantity[` + _stocknumber + `]" style="border:none;"  /></td>
				<td><input type="text" class="form-control text-center" value="` + _unitprice + `" name="unitprice[` + _stocknumber + `]" style="border:none;"  /></td>
				<td><button type="button" class="remove btn btn-md btn-danger text-center"><span class="glyphicon glyphicon-remove"></span></button></td>
			</tr>
		`)
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

	function setDate(object){
			var object_val = $(object).val()
			var date = moment(object_val).format('MMM DD, YYYY');
			$(object).val(date);
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
				$('#unitprice').val(response);
			}
		})
    })
})
</script>
@endsection
