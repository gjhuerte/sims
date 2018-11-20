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

<!-- Stock Card Table -->
<div class="col-sm-12" style="padding: 10px;">
  <legend><h3 class="text-center text-muted">Request List</h3></legend>
  <table class="table table-hover table-condensed table-striped table-bordered" id="supplyTable" style="padding:20px;margin-right: 10px;">
    <thead>
      <tr>
        <th class="col-sm-1">Stock Number</th>
        <th class="col-sm-1">Information</th>
        <th class="col-sm-1">Unit</th>
        <th class="col-sm-1">Remaining Balance</th>
        <th class="col-sm-1">Requested Quantity</th>
        <th class="col-sm-1">Issued Quantity</th>
        <th class="col-sm-1">Comments</th>
      </tr>
    </thead>
    <tbody>

      @if(isset($request->supplies))
          @foreach($request->supplies as $supply)
          <tr @if($supply->temp_balance <= 0) class="danger" @endif>
            <td>{{ $supply->stocknumber }}<input type="hidden" name="stocknumber[]" value="{{ $supply->stocknumber }}" /></td>
            <td>{{ $supply->details }}</td>
            <td>{{ $supply->unit->name }}</td>
            <td class="supply-balance">{{ $supply->temp_balance }}</td>
            <td>
              {{ $supply->pivot->quantity_requested }}
              <input type="hidden" name="requested[{{ $supply->stocknumber }}]" class="form-control" value="{{ $supply->pivot->quantity_requested }}" disabled />
            </td>
            <td>
              <input type="number" name="quantity[{{ $supply->stocknumber }}]" class="form-control" value="{{ ($supply->pivot->quantity_requested <= $supply->temp_balance) ? $supply->pivot->quantity_requested : 0 }}" />
            </td>
            <td>
              <input type="text" name="comment[{{ $supply->stocknumber }}]" class="comment form-control" value="" />
            </td>
          </tr>
        @endforeach
      @else
        @if(null !== old('stocknumber'))
          @foreach(old('stocknumber') as $stocknumber)

          {{-- fetch the details for supply --}}
          @php 
            $supply = App\Supply::findByStockNumber($stocknumber);
          @endphp
          {{-- fetch the details for supply --}}

          <tr @if($supply->temp_balance <= 0) class="danger" @endif>
            <td>"{{ $stocknumber }}<input type="hidden" name="stocknumber[]" value=""{{ $stocknumber }}" /></td>
            <td>{{ $supply->details }}</td>
            <td class="supply-balance">{{ $supply->temp_balance }}</td>
            <td>
              {{ old("requested.$stocknumber") }}
              <input type="hidden" name="requested["{{ $stocknumber }}]" class="form-control" value="{{ old("requested.$stocknumber") }}"  />
            </td>
            <td>
              <input type="number" name="quantity["{{ $stocknumber }}]" class="form-control" value="{{ old("quantity.$stocknumber") }}"  />
            </td>
            <td>
              <input type="text" name="comment["{{ $stocknumber }}]" class="comment form-control" />
            </td>
          </tr>
          @endforeach
        @endif
      @endif

      <tr>
        <td colspan=6 class="text-muted text-center"> ** Nothing Follows **</td>
      </tr>

    </tbody>
  </table>
</div> <!-- end of Stock Card Table --> 

<!-- add stock fields -->
<!-- <div class="col-sm-12" style="margin-bottom: 20px;">
  <button type="button" id="add" class="btn btn-md btn-primary pull-right" data-target="#addStockNumberModal" data-toggle="modal">
    <span class="glyphicon glyphicon-plus"></span> Insert Additional Stock
  </button>
</div> -->
<!-- end of add stock fields --> 

<!-- purpose -->
<div class="col-sm-12">
  <label>Purpose</label>
  <blockquote> 
    <p style="font-size: 20px;">{{ $request->purpose }}</p> 
  </blockquote>
</div>

<!-- remarks fields -->
<div class="form-group" style="padding: 10px;">
  <div class="col-md-12">
    <label>Additional Remarks</label>
    <textarea class="form-control" rows="8"  id="remarks" name="remarks" placeholder="Input additional comments/remarks">{{  old('remarks') }}</textarea>
  </div>
</div> <!-- end of remarks fields -->

<!-- buttons -->
<div class="panel-footer">

  <input type="hidden" name="action" id="action" />

  <!-- action buttons -->
  <div class="pull-left">
      <button type="submit" name="disapprove" id="disapprove" class="btn btn-md btn-danger" value="disapprove">Disapprove</button><!-- 
      <button type="submit" name="resubmit" id="resubmission" class="btn btn-md btn-warning" value="resubmission">Resubmission</button> -->
  </div> <!-- end of action buttons -->
  <!-- action buttons -->
  <div class="pull-right">
      <button type="submit" name="approve" id="approve" class="btn btn-md btn-success" value="approve">Approve</button>
      <a type="button" id="cancel" class="btn btn-md btn-default" href="{{ url("request/$request->id") }}">Cancel</a>
  </div> <!-- end of action buttons -->

  <div class="clearfix"></div>
</div> <!-- end of buttons -->

@section('after_scripts')

<script>
  jQuery(document).ready(function($) {
    $(document).ready(function(){
      trigger = 0;
      $('.supply-balance').each(function(){
        text = $(this).text()
        if( text != 0 )
        {
          trigger = 1;
        }
      })

      if( trigger == 0 )
      {

        swal({
          title: "Warning!",
          text: "You have no items to release for this request. Do you want to disapprove it?",
          type: "warning",
          showCancelButton: true,
          confirmButtonText: "Yes, disapprove it!",
          cancelButtonText: "No, cancel it!",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm){
          if (isConfirm) {
            $('.comment').val('')
            $('#remarks').val('No items to allocate')
            $('#disapprove').trigger('click')
          } else {
            swal("Cancelled", "Operation Cancelled", "error");
          }
        })
      }
    })

    $('#approve, #disapprove, #resubmission').on('click',function(event){

      action = $(this).val();
      event.preventDefault()

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
                $('#action').val(action)
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
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'get',
        url: '{{ url('inventory/supply') }}' +  '/' + stocknumber,
        dataType: 'json',
        success: function(response){
            $('#supplyTable > tbody ').prepend(`
                <tr>
                  <td>`+response.data.stocknumber+`<input type="hidden" name="stocknumber[]" value="`+response.data.stocknumber+`" /></td>
                  <td>`+response.data.details+`</td>
                  <td class="supply-balance">`+response.data.temp_balance+`</td>
                  <td>`+quantity+`<input type="hidden" name="requested[`+response.data.stocknumber+`]" class="form-control" value="`+quantity+`"  /></td>
                  <td><input type="number" name="quantity[`+response.data.stocknumber+`]" class="form-control" value="`+issued+`"  /></td>
                  <td><input type="text" name="comment[`+response.data.stocknumber+`]" class="comment form-control" /></td>
                </tr>
            `)

        }
      })
    }

  });
</script>
@endsection