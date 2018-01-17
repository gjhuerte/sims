<!-- custom styles -->
<style>

  th , tbody{
    text-align: center;
  }
</style>
<!-- end of custom styles -->

<!-- included fields -->
@include('modal.request.supply')
@include('errors.alert')
<!-- end of include fields --> 

<legend><h3 class="text-muted">Request Slip: {{ $request->code }}</h3></legend>

<!-- Stock Card Table -->
<div class="col-sm-12" style="padding: 10px;">
  <h3 class="line-either-side text-muted">Request List</h3>
  <table class="table table-hover table-condensed table-striped table-bordered" id="supplyTable" style="padding:20px;margin-right: 10px;">
    <thead>
      <tr>
        <th class="col-sm-1">Stock Number</th>
        <th class="col-sm-1">Information</th>
        <th class="col-sm-1">Remaining Balance</th>
        <th class="col-sm-1">Requested Quantity</th>
        <th class="col-sm-1">Issued Quantity</th>
        <th class="col-sm-1">Comments</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td colspan=6 class="text-muted text-center"> ** Nothing Follows **</td>
      </tr>
    </tbody>
  </table>
</div> <!-- end of Stock Card Table -->  

<!-- purpose -->
<div class="form-group" style="padding: 10px;">
  <div class="col-sm-12">
    <label>Purpose</label>
    <textarea class="form-control" readonly disabled style="background-color: white;">{{ $request->purpose }}</textarea>
  </div>
</div>

<!-- remarks fields -->
<div class="form-group" style="padding: 10px;">
  <div class="col-md-12">
    <label>Remarks</label>
    <textarea class="form-control" name="remarks" value="{{ old('remarks') }}" placeholder="Input additional comments/remarks"></textarea>
  </div>
</div> <!-- end of remarks fields -->

<!-- buttons -->
<div style="padding: 10px;">
  <!-- add stock fields -->
  <button type="button" id="add" class="btn btn-md btn-primary pull-left" data-target="#addStockNumberModal" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Add Stock</button>
  <!-- end of add stock fields -->

  <!-- action buttons -->
  <div class="pull-right">
    <div class="btn-group">
      <button type="button" id="approve" class="btn btn-md btn-success btn-block">Approve</button>
    </div>
    <div class="btn-group">
        <a type="button" id="cancel" class="btn btn-md btn-default" href="{{ url("request/$request->id") }}">Cancel</a>
    </div>
  </div> <!-- end of action buttons -->
</div> <!-- end of buttons -->

@section('after_scripts')

<script>
  jQuery(document).ready(function($) {

    $('#approve').on('click',function(){
      console.log($('#supplyTable > tbody > tr').length)
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
                $('#requestForm').submit();
              } else {
                swal("Cancelled", "Operation Cancelled", "error");
              }
            })
      }
    })

    $('#supplyInventoryTable').on('click','.add-stock',function(){

      insertRow($(this).data('id'))
      $('#addStockNumberModal').modal('hide')

    })

    function insertRow(stocknumber, quantity=0, issued=0)
    {

      error = false

      $('.stocknumber-list').each(function() {
          if (stocknumber == $(this).val())
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

      $.ajax({
        type: 'get',
        url: '{{ url('inventory/supply') }}' +  '/' + stocknumber,
        dataType: 'json',
        success: function(response){
            $('#supplyTable > tbody ').prepend(`
                <tr>
                  <td>`+response.data.stocknumber+`<input type="hidden" name="stocknumber[]" value="`+response.data.stocknumber+`" /></td>
                  <td>`+response.data.details+`</td>
                  <td>`+response.data.stock_balance+`</td>
                  <td>`+quantity+`<input type="hidden" name="requested[`+response.data.stocknumber+`]" class="form-control" value="`+quantity+`"  /></td>
                  <td><input type="number" name="quantity[`+response.data.stocknumber+`]" class="form-control" value="`+issued+`"  /></td>
                  <td><input type="text" name="comment[`+response.data.stocknumber+`]" class="form-control" /></td>
                </tr>
            `)

        }
      })
    }

@if(null !== old('stocknumber'))
  @foreach(old('stocknumber') as $stocknumber)
    insertRow("{{ $stocknumber }}", "{{ old("requested.$stocknumber") }}",  "{{ old("quantity.$stocknumber") }}")
  @endforeach
@endif

@if(isset($request->supplies))
    @foreach($request->supplies as $supply)
    insertRow("{{ $supply->stocknumber }}", "{{ $supply->pivot->quantity_requested }}", "{{ $supply->pivot->quantity_requested }}")
  @endforeach
@endif

  });
</script>
@endsection