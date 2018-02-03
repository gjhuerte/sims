@extends('backpack::layout')

@section('header')
	<section class="content-header">
	  <h1>
	    Request No. {{ $code }}
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="{{ url('request') }}">Request</a></li>
	    <li class="active">Create</li>
	  </ol>
	</section>
@endsection

@section('content')
@include('modal.request.supply')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
    {{ Form::open(['method'=>'post','route'=>array('request.store'),'class'=>'form-horizontal','id'=>'requestForm']) }}
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
        <div class="form-group" style="margin-top: 20px">
          <div class="col-sm-12">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
          {{ Form::label('stocknumber','Stock Number') }}
          </div>
          <div class="col-sm-10">
          {{ Form::text('stocknumber',null,[
            'id' => 'stocknumber',
            'class' => 'form-control',
            'placeholder' => 'Supply Sock Number '
          ]) }}
          <p class="text-muted" style="font-size: 10px">Press <strong>Add</strong> Button to search for list of supplies</p>
          </div>
          <div class="col-sm-1" style="padding-left:0px;">
            <button type="button" id="add-stocknumber" class="btn btn-default">Add</button>
          </div>
        </div>
        <input type="hidden" id="supply-item" />
        <div id="stocknumber-details"></div>
        <div class="col-md-12">
          <div class="form-group">
          {{ Form::label('Quantity') }}
          {{ Form::number('quantity','',[
            'id' => 'quantity',
            'class' => 'form-control',
            'placeholder' => 'Quantity Requested'
          ]) }}
          </div>
        </div>
        <div class="btn-group" style="margin-bottom: 20px">
          <button type="button" id="add" class="btn btn-md btn-success"><span class="glyphicon glyphicon-plus"></span> Add</button>
        </div>
      </div>
      <div class="col-sm-offset-1 col-sm-7 list-group-item" style="padding:20px;">
        <h3 class="line-either-side text-muted">Request List</h3>
        <table class="table table-hover table-condensed table-striped" id="supplyTable">
          <thead>
            <tr>
              <th class=col-sm-1>Stock Number</th>
              <th class=col-sm-1>Information</th>
              <th class=col-sm-1>Quantity</th>
              <th class=col-sm-1></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan=4 class="text-muted hide-me"> No items to show</td>
            </tr>
          </tbody>
        </table>
        <div class="pull-right">
          <div class="btn-group">
            <button type="button" id="request" class="btn btn-md btn-primary btn-block">Request</button>
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
  jQuery(document).ready(function($) {


    $('#stocknumber').autocomplete({
      source: "{{ url("get/inventory/supply/stocknumber") }}"
    })

    $('#office').autocomplete({
      source: "{{ url('get/office/code') }}"
    })

    $('#request').on('click',function()
    {
      if($('#supplyTable > tbody > tr').length == 0 || $('.hide-me').is(':visible'))
      {
        swal('Blank Field Notice!','Supply table must have atleast 1 item','error')
      }
      else
      {
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
                $('#requestForm').submit();
              } else {
                swal("Cancelled", "Operation Cancelled", "error");
              }
            })
      }
    })

    $('#cancel').on('click',function(){
      window.location.href = "{{ url('inventory/supply') }}"
    })

    $('#stocknumber').on('change',function(){
      setStockNumberDetails()
    })

    $( "#date" ).datepicker({
        changeMonth: true,
        changeYear: false,
        maxAge: 59,
        minAge: 15,
    });

    function setStockNumberDetails()
    {
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
            $('#supply-item').val(details.toString())
            $('#stocknumber-details').html(`
              <div class="alert alert-info">
                <ul class="list-unstyled">
                  <li><strong>Item:</strong> ` + details + ` </li>
                  <li><strong>Remaining Balance:</strong> ` + response.data.balance + ` </li>
                </ul>
              </div>
            `)

            $('#add').show()
          } catch (e) {
            $('#stocknumber-details').html(`
              <div class="alert alert-danger">
                <ul class="list-unstyled">
                  <li>Invalid Stock Number</li>
                </ul>
              </div>
            `)

            $('#add').hide()
          }
        }
      })
    }

    $('#add').on('click',function(){
      stocknumber = $('#stocknumber').val()
      quantity = $('#quantity').val()
      details = $('#supply-item').val()
      addForm(stocknumber,details,quantity)
      $('#stocknumber').text("")
      $('#quantity').text("")
      $('#stocknumber-details').html("")
      $('#stocknumber').val("")
      $('#quantity').val("")
      $('#add').hide()
    })

    $('#add-stocknumber').on('click',function(){
      $('#addStockNumberModal').modal('show');
    })

    function addForm(_stocknumber = "",_info ="" ,_quantity = "")
    {

      row = parseInt($('#supplyTable > tbody > tr:last').text())
      if(isNaN(row))
      {
        row = 1
      } else
      {
        row++
      }

      $('.hide-me').hide()

      $('#supplyTable > tbody').append(`
        <tr>
          <td><input type="hidden" class="form-control text-center" value="` + _stocknumber + `" name="stocknumber[` + _stocknumber + `]" style="border:none;background-color:white;" readonly />` + _stocknumber + `</td>
          <td><input type="hidden" class="form-control text-center" value="` + _info + `" name="info[` + _stocknumber + `]" style="border:none;" />` + _info + `</td>
          <td><input type="hidden" class="form-control text-center" value="` + _quantity + `" name="quantity[` + _stocknumber + `]" style="border:none;background-color:white;" readonly />` + _quantity + `</td>
          <td><button type="button" class="remove btn btn-sm btn-danger text-center"><span class="glyphicon glyphicon-remove"></span> Remove</button></td>
        </tr>
      `)
    }

    $('#supplyInventoryTable').on('click','.add-stock',function(){
      $('#stocknumber').val($(this).data('id'))
      $('#addStockNumberModal').modal('hide')
      setStockNumberDetails()
    })

    $('#date').on('change',function(){
      setDate("#date");
    });

    $('#cancel').on('click',function(){
      window.location.href = "{{ url('request') }}"
    })

    $('#supplyTable').on('click','.remove',function(){
      $(this).parents('tr').remove()
      console.log($('#supplyTable > tbody > tr').length)
      if($('#supplyTable > tbody > tr').length == 1)
      {
        $('.hide-me').show()
      }
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
      addForm("{{ $stocknumber }}","{{ old("info.$stocknumber") }}", "{{ old("quantity.$stocknumber") }}")
      @endforeach

    }

    init();

    @endif

    @if(Input::old('date'))
      $('#date').val('{{ Input::old('date') }}');
      setDate("#date");
    @else
      $('#date').val('{{ Carbon\Carbon::now()->toFormattedDateString() }}');
      setDate("#date");
    @endif

  });
</script>
@endsection
