<!-- included fields -->
@include('modal.request.supply')
@include('errors.alert')
<!-- end of include fields --> 

<!-- Stock Card Table -->
<div class="col-sm-12" style="padding: 10px;">

  <h3>
    Inspection {{ $inspection->code }}
  </h3>

  <ol class="breadcrumb">
    <li><a href="{{ url("inspection/$inspection->id") }}">Inspection</a></li>
    <li class="active">Approval</li>
  </ol>

  <ul class="list-group">
    <li class="list-group-item"><strong>Purchase Order:</strong> {{ $inspection->purchaseorder_number }}</li>
    <li class="list-group-item"><strong>Receipt:</strong> {{ $inspection->receipt_number }} | {{ Carbon\Carbon::parse($inspection->created_at)->toFormattedDateString() }} | {{ $inspection->supplier }}</li>
    <li class="list-group-item"><strong>Submitted By:</strong> {{ App\User::find($inspection->received_by)->fullname }} | {{ Carbon\Carbon::parse($inspection->created_at)->toFormattedDateString() }}</li>
    <li class="list-group-item"><strong>Status:</strong> {{ $inspection->status }}</li>
  </ul>

  <hr />

  <table class="table table-hover table-condensed table-striped table-bordered" id="supplyTable" style="padding:20px;margin-right: 10px;">
    <thead>
      <tr>
        <th class="col-sm-1">Stock Number</th>
        <th class="col-sm-1">Information</th>
        <th class="col-sm-1">Quantity</th>
        <th class="col-sm-1">Inspected Quantity</th>
      </tr>
    </thead>
    <tbody>

      @if(isset($inspection->supplies))
          @foreach($inspection->supplies as $supply)
          <tr>
            <td>{{ $supply->stocknumber }}
              <input type="hidden" name="stocknumber[]" value="{{ $supply->stocknumber }}" />
            </td>
            <td>{{ $supply->details }}</td>
            <td>
              {{ $supply->pivot->quantity_received }}
              <input type="hidden" name="received[{{ $supply->stocknumber }}]" class="form-control" value="{{ $supply->pivot->quantity_received }}"  />
            </td>
            <td>
              <input type="number" name="quantity[{{ $supply->stocknumber }}]" class="form-control" value="{{ $supply->pivot->quantity_received }}" value="{{ $supply->pivot->quantity_received }}"  />
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

          <tr>
            <td>"{{ $stocknumber }}
              <input type="hidden" name="stocknumber[]" value=""{{ $stocknumber }}" />
            </td>
            <td>{{ $supply->details }}</td>
            <td>
              {{ old("received.$stocknumber") }}
              <input type="hidden" name="received["{{ $stocknumber }}]" class="form-control" value="{{ old("received.$stocknumber") }}"  />
            </td>
            <td>
              <input type="number" name="quantity["{{ $stocknumber }}]" class="form-control" value="{{ old("quantity.$stocknumber") }}"  />
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
{{-- <div class="col-sm-12" style="margin-bottom: 20px;">
  <button type="button" id="add" class="btn btn-md btn-primary pull-right" data-target="#addStockNumberModal" data-toggle="modal">
    <span class="glyphicon glyphicon-plus"></span> Insert Additional Stock
  </button>
</div> --}}
<!-- end of add stock fields --> 


<!-- remarks fields -->
<div class="form-group" style="padding: 10px;">
  <div class="col-md-12">
    <label>Additional Remarks</label>
    <textarea class="form-control" rows="8" name="remarks" placeholder="Input additional comments/remarks">{{ old('remarks') }}</textarea>
  </div>
</div> <!-- end of remarks fields -->

<!-- buttons -->
<div class="panel-footer" style="padding: 10px;">

  <input type="hidden" name="action" id="action" />

  <!-- action buttons -->
  <div class="pull-left">
    <div class="btn-group">
      <button type="submit" name="failed" id="failed" class="btn btn-md btn-danger btn-block" value="failed">Failed</button>
    </div>
  </div> <!-- end of action buttons -->

  <!-- action buttons -->
  <div class="pull-right">
    <div class="btn-group">
      <button type="submit" name="passed" id="passed" class="btn btn-md btn-success btn-block" value="passed">Passed</button>
    </div>
    <div class="btn-group">
        <a type="button" id="cancel" class="btn btn-md btn-default" href="{{ url("inspection/$inspection->id") }}">Cancel</a>
    </div>
  </div> <!-- end of action buttons -->
</div> <!-- end of buttons -->

@section('after_scripts')

<script>
  jQuery(document).ready(function($) {

    $('#passed, #failed, #resubmission').on('click',function(event){

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
                $('#inspectionForm').submit();
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
                  <td>`+quantity+`<input type="hidden" name="received[`+response.data.stocknumber+`]" class="form-control" value="`+quantity+`"  /></td>
                  <td><input type="number" name="quantity[`+response.data.stocknumber+`]" class="form-control" value="`+issued+`"  /></td>
                </tr>
            `)

        }
      })
    }

  });
</script>
@endsection