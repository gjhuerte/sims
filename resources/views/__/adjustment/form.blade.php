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
      'placeholder' => 'Supply Stock Number '
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
      'placeholder' => 'Quantity'
    ]) }}
    </div>
  </div>
  <div class="col-md-12">
    <div class="form-group">
    {{ Form::label('Unit Cost') }}
    {{ Form::text('unitcost','',[
      'id' => 'unitcost',
      'class' => 'form-control',
      'placeholder' => 'Unit Cost'
    ]) }}
    </div>
  </div>
  <div class="btn-group" style="margin-bottom: 20px">
    <button type="button" id="add" class="btn btn-md btn-success"><span class="glyphicon glyphicon-plus"></span> Add</button>
  </div>
</div>
<div class="col-sm-offset-1 col-sm-7 list-group-item" style="padding:20px;">
  <h3 class="line-either-side text-muted">Item List</h3>
  <table class="table table-hover table-condensed table-striped" id="supplyTable">
    <thead>
      <tr>
        <th class=col-sm-1>Stock Number</th>
        <th class=col-sm-1>Information</th>
        <th class=col-sm-1>Quantity</th>
        <th class=col-sm-1>Unit Cost</th>
        <th class=col-sm-1></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td colspan=5 class="text-muted text-center hide-me"> No items to show</td>
      </tr>
    </tbody>
  </table>
</div>
<div class="col-sm-12">
  <hr />
  <label>Details for Adjusting</label>
  <textarea name="details" id="details" class="form-control" placeholder="Enter Details..."></textarea>
</div>
<div class="col-sm-12">
  <div class="pull-right" style="margin-top: 20px;">
    <div class="btn-group">
      <button type="button" id="request" class="btn btn-md btn-primary btn-block">
      @if(isset($action))
        @if($action == 'create')
        <span>Submit</span>
        @elseif($action == 'dispose')
        <span>Dispose</span>
        @else
        <span>No Action</span>
        @endif
      @else
        <span>No Action</span>
      @endif
      </button>
    </div>
    <div class="btn-group">
      <a type="button" id="cancel" class="btn btn-md btn-default" href="{{ url('inventory/supply') }}">Cancel</a>
    </div>
  </div>
</div>


@section('after_scripts')

<script>
  jQuery(document).ready(function($) {

    $('#stocknumber').autocomplete({
      source: "{{ url("get/inventory/supply/stocknumber") }}"
    })

    $('#office').autocomplete({
      source: "{{ url('get/office/code') }}"
    })

    $( "#date" ).datepicker({
        changeMonth: true,
        changeYear: false,
        maxAge: 59,
        minAge: 15,
    });

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
                $('#adjustmentForm').submit();
              } else {
                swal("Cancelled", "Operation Cancelled", "error");
              }
            })
      }
    })

    $('#stocknumber').on('change',function(){
      setStockNumberDetails()
    })

    function setStockNumberDetails()
    {
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
                  <li><strong>Remaining Balance:</strong> ` + response.data.stock_balance + ` </li>
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
      unitcost = $('#unitcost').val()
      
      if(addForm(stocknumber,details,quantity, unitcost))
      {
        $('#stocknumber-details').html("")
        $('#stocknumber').val("")
        $('#quantity').val("")
        $('#unitcost').val("")
      }
    })

    function addForm(_stocknumber = "",_info = "" ,_quantity = "", _unitcost = 0)
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


      $('.hide-me').hide()

      $('#supplyTable > tbody').append(`
        <tr>
          <td>
            <input type="text" class="stocknumber-list form-control text-center" value="` + _stocknumber + `" name="stocknumber[` + _stocknumber + `]" style="border:none;" />
          </td>
          <td><input type="hidden" class="form-control text-center" value="` + _info + `" name="info[` + _stocknumber + `]" style="border:none;" />` + _info + `</td>
          <td><input type="number" class="form-control text-center" value="` + _quantity + `" name="quantity[` + _stocknumber + `]" style="border:none;"  /></td>
          <td><input type="text" class="form-control text-center" value="` + _unitcost + `" name="unitcost[` + _stocknumber + `]" style="border:none;"  /></td>
          <td><button type="button" class="remove btn btn-md btn-danger text-center"><span class="glyphicon glyphicon-remove"></span></button></td>
        </tr>
      `)

      return true;
    }

    $('#add-stocknumber').on('click',function(){
      $('#addStockNumberModal').modal('show');
    })

    $('#supplyInventoryTable').on('click','.add-stock',function(){
      $('#stocknumber').val($(this).data('id'))
      $('#addStockNumberModal').modal('hide')
      setStockNumberDetails()
    })

    $('#date').on('change',function(){
      setDate("#date");
    });

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
      addForm("{{ $stocknumber }}","{{ old("info.$stocknumber") }}", "{{ old("quantity.$stocknumber") }}", "{{ old("unitcost.$stocknumber") }}")
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

@yield('additional_scripts')
@endsection