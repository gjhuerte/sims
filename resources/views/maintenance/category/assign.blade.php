@extends('backpack::layout')

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">Categories</h3></legend>
      <ol class="breadcrumb">
          <li>
              <a href="{{ url('maintenance/category') }}">Category</a>
          </li>
          <li class="active">{{ $category->id }}</li>
          <li class="active">Assign</li>
      </ol>
	</section>
@endsection

@section('content')
@include('modal.request.supply')  
<!-- Default box -->
  <div class="box" style="padding:10px;">
    <div class="box-body">
    {{ Form::open(['method'=>'put','url'=>array("maintenance/category/assign/$category->id"),'class'=>'form-horizontal','id'=>'acceptForm']) }}
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
      <div class="btn-group" style="margin-bottom: 20px;">
        <button type="button" id="add" class="btn btn-md btn-success"><span class="glyphicon glyphicon-plus"></span> Add</button>
      </div>
    </div>
    <div class="col-sm-8">
      <legend class="text-muted"><h3>Supplies</h3></legend>
      <table class="table table-hover table-condensed table-bordered" id="supplyTable">
        <thead>
          <tr>
            <th>Stock Number</th>
            <th>Information</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
      <div class="pull-right">
        <div class="btn-group">
          <button type="button" id="accept" class="btn btn-md btn-primary btn-block">Assign</button>
        </div>
        <div class="btn-group">
          <button type="button" id="cancel" class="btn btn-md btn-default" onclick='window.location.href="{{ url("maintenance/category") }}"''>Cancel</button>
        </div>
      </div>
    </div>
    {{ Form::close() }}
    </div><!-- /.box-body -->
  </div><!-- /.box -->


@endsection

@section('after_scripts')
<script>
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
          balance = response.data.stock_balance
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

  $('#add').on('click',function(){
    row = parseInt($('#supplyTable > tbody > tr:last').text())
    if(isNaN(row))
    {
      row = 1
    } else row++

    stocknumber = $('#stocknumber').val()
    details = $('#supply-item').val()
    if(addForm(row,stocknumber,details))
    {
      $('#stocknumber-details').html("")
      $('#stocknumber').val("")
    }
  })

  function addForm(row,_stocknumber = "",_info ="")
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
        <td><button type="button" class="remove btn btn-md btn-danger text-center"><span class="glyphicon glyphicon-remove"></span></button></td>
      </tr>
    `)

    return true;
  }

  $('#supplyTable').on('click','.remove',function(){
    $(this).parents('tr').remove()
  })



  function init()
  {

    @foreach($supply as $supply)
    row = parseInt($('#supplyTable > tbody > tr:last').text())
    if(isNaN(row))
    {
      row = 1
    } else row++

    addForm(row,"{{ $supply->stocknumber }}","{{ $supply->details }}")
    @endforeach

    @if(null !== old('stocknumber'))
    @foreach(old('stocknumber') as $stocknumber)
    row = parseInt($('#supplyTable > tbody > tr:last').text())
    if(isNaN(row))
    {
      row = 1
    } else row++

    addForm(row,"{{ $stocknumber }}","{{ old("info.$stocknumber") }}")
    @endforeach

    @endif

  }

  init()

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
</script>
@endsection