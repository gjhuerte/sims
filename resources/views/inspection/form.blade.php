

<!-- custom styles -->
<style>
  .border-shadow {
    -webkit-box-shadow: 11px 12px 16px -9px rgba(176,167,176,1);
    -moz-box-shadow: 11px 12px 16px -9px rgba(176,167,176,1);
    box-shadow: 11px 12px 16px -9px rgba(176,167,176,1);
  }

  .is-required{
    display: none;
  }
</style>
<!-- end of custom styles -->

<!-- Display Errors -->
@include('errors.alert')
<div class="alert alert-danger alert-dismissible is-required" id="warningAlert" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Warning!</strong> The fields in <em>red</em> are required. Please input the corresponding data in the fields.
</div>

<!-- Stock Card Form -->
<div class="col-sm-4" style="margin-top:20px;">
  <div class="form-group" id="stocknumber-form">
    <div class="col-sm-12">
      <label for="stocknumber">Stock Number</label> <div class="text-danger is-required">Field Required</div>
    </div>
    <div class="col-sm-9">
      <input type="text" class="form-control" placeholder="Supply Stock Number" id="stocknumber" />
      <p class="text-muted" style="font-size: 12px">Press <strong>Add</strong> Button to search for list of supplies</p>
      <p class="text-muted" style="font-size: 12px">You can also print a copy of <a target="_blank" href="{{ url('inventory/supply/all/print') }}">Stock Masterlist</a></p>
    </div>
    <div class="col-sm-1" style="padding-left:0px;">
      <button type="button" id="add-stocknumber" class="btn btn-default" data-target="#addStockNumberModal" data-toggle="modal">Search</button>
    </div>
  </div>

  <!-- shows the details for the stocknumber -->
  <input type="hidden" id="supply-item" />
  <div id="stocknumber-details"></div>
  <!-- end details display -->

  <div class="col-md-12">
    <div class="form-group" id="quantity-form">
      <label for="Quantity">Quantity</label> <div class="text-danger is-required">Field Required</div>
      <input id="quantity" class="form-control" placeholder="Quantity Requested" name="quantity" type="number" value="">
    </div>
  </div>
  <div class="btn-group" style="margin-bottom: 20px">
    <button type="button" id="add" class="btn btn-md btn-success"><span class="glyphicon glyphicon-plus"></span> Add</button>
  </div>
</div> <!-- end of Stock Card Form -->

<!-- Stock Card Table -->
<div class="col-sm-8" style="padding: 10px;">
  <h3 class="line-either-side text-muted">Request List</h3>
  <table class="table table-hover table-condensed table-striped table-bordered" id="supplyTable" style="padding:20px;margin-right: 10px;">
    <thead>
      <tr>
        <th class="col-sm-1 text-center">Stock Number</th>
        <th class="col-sm-1 text-center">Information</th>
        <th class="col-sm-1 text-center">Quantity</th>
        <th class="col-sm-1 text-center"></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td colspan=4 class="text-muted text-center"> ** Nothing Follows **</td>
      </tr>
    </tbody>
  </table>
</div> <!-- end of Stock Card Table -->    

<!-- additional forms -->
<div class="col-sm-12">
  <!-- Request Purpose -->
  <div class="col-sm-12">
    <div class="form-group">
      <label for="purpose">Purpose</label> <div class="text-danger is-required">Field Required</div>
        <input type="text" id="purpose" class="form-control" placeholder="Enter Details here.... " rows="2" name="purpose" value="{{ isset($request->purpose) ? $request->purpose : old('purpose') }}">
    </div>
  </div> <!-- end of Request Purpose -->
  <div class="pull-right">
    <div class="btn-group">
      <button type="button" id="request" class="btn btn-md btn-primary btn-block">Request</button>
    </div>
    <div class="btn-group">
      <a type="button" id="cancel" class="btn btn-md btn-default" href="{{ isset($request->id) ? url("request/$request->id") : url("request") }}">Cancel</a>
    </div>
  </div>
</div> <!-- end of additional forms -->



@section('after_scripts')

<script>
  jQuery(document).ready(function($) {

    $('#stocknumber').autocomplete({  source: "{{ url("get/inventory/supply/stocknumber") }}" })
    $('#office').autocomplete({ source: "{{ url('get/office/code') }}"  })

    $('#request').on('click',function()
    {
      if($('#supplyTable > tbody > tr').length == 0 || $('.hide-me').is(':visible'))
      {
        swal('Blank Field Notice!','Supply table must have atleast 1 item','error')
      }
      else
      {

        purpose = $('#purpose')
        if(hasNoErrors(purpose))
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
      }
    })

    $('#stocknumber').on('change',function(){ setStockNumberDetails()  })
    $( "#date" ).datepicker({  changeMonth: true,  changeYear: false,  maxAge: 59, minAge: 15, });

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
            data = response.data
            details = response.data.details
            unit = data.unit.name
            $('#supply-item').val(details.toString())
            $('#stocknumber-details').html(`
              <div class="alert alert-info">
                <ul class="list-unstyled">
                  <li><strong>Item:</strong> ` + details + ` </li>
                  <li><strong>Unit:</strong> ` + unit + ` </li>
                  @if(Auth::user()->access == 1)
                  <li><strong>Remaining Balance:</strong> ` + response.data.stock_balance + ` </li>
                  @endif
                </ul>
              </div>
            `)

            $('#add').prop("disabled", false)
          } catch (e) {
            console.log(e)
            $('#stocknumber-details').html(`
              <div class="alert alert-danger">
                <ul class="list-unstyled">
                  <li>Invalid Stock Number</li>
                </ul>
              </div>
            `)

            $('#add').prop("disabled", true)
          }
        }
      })
    }

    $('#add').on('click',function(){
      stocknumber = $('#stocknumber')
      quantity = $('#quantity')
      details = $('#supply-item')

      if(hasNoErrors(stocknumber) && hasNoErrors(quantity) && invalidDetails(details))
      {
        addForm(stocknumber.val(), details.val(), quantity.val() )
      }
    })

    function hasNoErrors(object)
    {
      obj_val = object.val()

      if(obj_val == "" || obj_val == null || obj_val === "" )
      {
        object.closest('div[class^="form-group"]').addClass('has-error');
        object.closest('div[class^="is-required"]').show();
        $('#warningAlert').show()
        return false;
      }
      else
      {
        object.closest('div[class^="form-group"]').removeClass('has-error');
        object.closest('div[class^="is-required"]').hide();
        $('#warningAlert').hide()
      }

      return true;
    }

    function invalidDetails(object)
    {
      obj_val = object.val()

      if(obj_val == "" || obj_val == null || obj_val === "" )
      {
        setStockNumberDetails()
        return false;
      }

      return true;
    }

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

      $('#supplyTable > tbody').prepend(`
        <tr>
          <td><input type="text" class="stocknumber-list form-control text-center" value="` + _stocknumber + `" name="stocknumber[` + _stocknumber + `]" style="border:none;" /></td>
          <td><input type="hidden" class="form-control text-center" value="` + _info + `" name="info[` + _stocknumber + `]" style="border:none;" />` + _info + `</td>
          <td><input type="number" class="form-control text-center" value="` + _quantity + `" name="quantity[` + _stocknumber + `]" style="border:none;"  /></td>
          <td><button type="button" class="remove btn btn-md btn-danger text-center"><span class="glyphicon glyphicon-remove"></span> Remove</button></td>
        </tr>
      `)

      resetFields()
      return true;
    }

    function resetFields()
    {      
      $('#stocknumber-details').html("")
      $('#stocknumber').val("")
      $('#quantity').val("")
    }

    $('#supplyInventoryTable').on('click','.add-stock',function(){ 
      $('#stocknumber').val($(this).data('id')) 
      $('#addStockNumberModal').modal('hide') 
      setStockNumberDetails()  
    })

    $('#supplyTable').on('click','.remove',function(){
      $(this).parents('tr').remove()
      console.log($('#supplyTable > tbody > tr').length)
      if($('#supplyTable > tbody > tr').length == 1)
      {
        $('.hide-me').show()
      }
    })

@if(null !== old('stocknumber'))
  @foreach(old('stocknumber') as $stocknumber)
    addForm("{{ $stocknumber }}","{{ old("info.$stocknumber") }}", "{{ old("quantity.$stocknumber") }}")
  @endforeach
@endif

@if(isset($request->supplies))
    @foreach($request->supplies as $supply)
    addForm("{{ $supply->stocknumber }}","{{ $supply->details }}", "{{ $supply->pivot->quantity_requested }}")
  @endforeach
@endif

  });
</script>

@yield('additional_scripts')
@endsection
