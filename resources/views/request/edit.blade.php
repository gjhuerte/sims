@extends('backpack::layout')

@section('header')
  <section class="content-header">
    <h1>
      Request No. {{ $request->code }}
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
    {{ Form::open(['method'=>'put','route'=>array('request.update',$request->id),'class'=>'form-horizontal','id'=>'requestForm']) }}
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
              <th class=col-md-1>Stock Number</th>
              <th class=col-md-1>Information</th>
              <th class=col-md-1>Quantity</th>
              <th class=col-md-1></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan=4 class="text-muted hide-me text-center" hidden> No items to show</td>
            </tr>
          </tbody>
        </table>
        <div class="pull-right">
          <div class="btn-group">
            <button type="button" id="request" class="btn btn-md btn-primary btn-block">Update</button>
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

    $('#add-stocknumber').on('click',function(){
      $('#addStockNumberModal').modal('show');
    })

    $('#cancel').on('click',function(){
      window.location.href = "{{ url('request') }}"
    })

    $('#stocknumber').on('change',function(){

      _stocknumber = $('#stocknumber').val()
      _url = '{{ url('inventory/supply') }}' +  '/' + _stocknumber
      _alert = $('#stocknumber-details')
      _hidden = $('#supply-item')

      getStockNumberDetails(_stocknumber, _url, _alert, _hidden)
    })

    $('#add').on('click',function(){

      stocknumber = $('#stocknumber')
      quantity = $('#quantity')
      details = $('#supply-item')

      addForm(stocknumber.val(), details.val(), quantity.val())
      $('#stocknumber').text("")
      $('#quantity').text("")
      $('#stocknumber-details').html("")
      $('#stocknumber').val("")
      $('#quantity').val("")
    })

    function addForm(_stocknumber = "",_info ="" ,_quantity = "")
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

      row = parseInt($('#supplyTable > tbody > tr:last').text())
      if(isNaN(row))
      {
        row = 1
      } else
      {
        row++
      }

      $('#supplyTable > tbody').append(`
        <tr>
          <td><input type="hidden" class="stocknumber-list form-control text-center" value="` + _stocknumber + `" name="stocknumber[` + _stocknumber + `]" style="border:none;background-color:white;" readonly />` + _stocknumber + `</td>
          <td><input type="hidden" class="form-control text-center" value="` + _info + `" name="info[` + _stocknumber + `]" style="border:none;" />` + _info + `</td>
          <td><input type="text" class="form-control text-center" value="` + _quantity + `" name="quantity[` + _stocknumber + `]" style="border:none;background-color:white;" /></td>
          <td><button type="button" class="remove btn btn-sm btn-danger text-center"><span class="glyphicon glyphicon-remove"></span> Remove</button></td>
        </tr>
      `)
    }
    
    /* custom scripts */

    /* uses get method */
    /* uses ajax */
    /* include in the future csrf token if error */
    function getStockNumberDetails( _stocknumber = null, _url = null, _alert = null, _hidden = null )
    {
      
      /* init variables*/
      /*incluedes return values*/
      html_data = "";
      details = "";
      ret_val = "";

      $.ajax({

        type: 'get',
        url: _url,
        dataType: 'json',
        success: function(response){

          if(response.data)
          {
            details = response.data.details
            balance = response.data.balance
            ret_val = response.data
            html_data = `
              <div class="alert alert-info">
                <ul class="list-unstyled">
                  <li><strong>Item:</strong> ` + details + ` </li>
                  <li><strong>Remaining Balance:</strong> ` + balance + ` </li>
                </ul>
              </div>
            `
          }
          else
          {
            ret_val = null
            html_data = `
              <div class="alert alert-danger">
                <ul class="list-unstyled">
                  <li>Invalid Stock Number</li>
                </ul>
              </div>
            `
          }

          _alert.html(html_data)
          _hidden.val(details)
          return ret_val

        } /*,*/ /*uncomment the symbol beside me*/
        // error: function(response){
        //   swal('Error Occured')
        // }
        /* include an error part here.... */

      })
    }

    $('#supplyInventoryTable').on('click','.add-stock',function(){

      id = $(this).data('id')
      $('#stocknumber').val(id)
      $('#addStockNumberModal').modal('hide')

      _stocknumber = $('#stocknumber').val()
      _url = '{{ url('inventory/supply') }}' +  '/' + _stocknumber
      _alert = $('#stocknumber-details')
      _hidden = $('#supply-item')

      getStockNumberDetails(_stocknumber, _url, _alert, _hidden)

    })

    $('#supplyTable').on('click','.remove',function(){
      $(this).parents('tr').remove()

      if($('#supplyTable > tbody > tr').length == 1) $('.hide-me').show()
    })

    $('#request').on('click',function()
    {
      if($('#supplyTable > tbody > tr').length == 0)
      {
        swal('Blank Field Notice!','Supply table must have atleast 1 item','error')
      }
      else
      {
            swal({
              title: "Are you sure?",
              text: "This will updated the requested supplies. Do you want to continue?",
              type: "warning",
              showCancelButton: true,
              confirmButtonText: "Yes, update it!",
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

    @foreach($supplyrequest as $supplyrequest)
      addForm("{{ $supplyrequest->stocknumber }}","{{ $supplyrequest->supply->details }}", "{{ $supplyrequest->quantity_requested }}")
    @endforeach

    @if(null !== old('stocknumber'))

    @foreach(old('stocknumber') as $stocknumber)
      addForm("{{ $stocknumber }}","{{ old("info.$stocknumber") }}", "{{ old("quantity.$stocknumber") }}")
    @endforeach

    @endif

  });
</script>
@endsection
