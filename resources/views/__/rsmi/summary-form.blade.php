<!-- custom styles -->
<style>

  th , tbody{
    text-align: center;
  }
</style>
<!-- end of custom styles -->

@include('errors.alert')
<!-- end of include fields --> 

<legend><h3 class="text-muted">RSMI as of {{ $rsmi->parsed_report_date }}</h3></legend>

<form method="post" action="{{ url("rsmi/$rsmi->id/summary") }}" id="rsmiForm">

  <input type="hidden" name="_token" value="{{ csrf_token() }}" />

  <!-- Stock Card Table -->
  <div class="col-sm-12" style="padding: 10px;">
    <h3 class="line-either-side text-muted">RSMI List</h3>

    <table class="table table-hover table-condensed table-striped table-bordered" id="supplyTable" style="padding:20px;margin-right: 10px;">
      <thead>
          <th class="col-sm-1">Stock Number</th>
          <th class="col-sm-1">Item Description</th>
          <th class="col-sm-1">Qty</th>
          <th class="col-sm-1">Unit Cost</th>
          <th class="col-sm-1">Total Cost</th>
          <th class="col-sm-1">UACS Code</th>
      </thead>
      <tbody>
      @if(isset($summary))
        @foreach($summary as $report)
        <tr>
          <td>{{ $report->stocknumber }} <input type="hidden" value="{{ $report->stocknumber }}" name="id[]" ></td>
          <td>{{ $report->details }}</td>
          <td>{{ $report->issued_quantity }}</td>
          <td>{{ number_format($report->unitcost,2) }}</td>
          <td>{{ number_format($report->amount, 2) }}</td>
          <td>
            <input type="text" name="uacs[{{ $report->stocknumber }}]" data-stocknumber="{{ $report->stocknumber }}" class="stocknumber form-control" value="{{ old("$report->uacs") ? old("$report->uacs") : $report->uacs_code }}" />
          </td>
        </tr>
        @endforeach
      @endif
      </tbody>  
    </table>
  </div> <!-- end of Stock Card Table -->  

    <!-- action buttons -->
    <div class="pull-right">
      <div class="btn-group">
        <button type="button" id="approve" class="btn btn-md btn-success">Apply</button>
      </div>
      <div class="btn-group">
          <a type="button" id="cancel" class="btn btn-md btn-default" href="{{ url("rsmi/$rsmi->id") }}">Cancel</a>
      </div>
    </div> <!-- end of action buttons -->
  </div> <!-- end of buttons -->

</form>
@section('after_scripts')

<script>
  jQuery(document).ready(function($) {

    var table = $('#supplyTable').DataTable({
      pageLength: 100,
      columnDefs:[
        { targets: 'no-sort', orderable: false },
      ],
      language: {
          searchPlaceholder: "Search..."
      },
      "dom": "<'row'<'col-sm-3'l><'col-sm-6'<'toolbar'>><'col-sm-3'f>>" +
              "<'row'<'col-sm-12'tr>>" +
              "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    });

    $('#approve').on('click',function(){

      if($('#supplyTable > tbody > tr').length == 0)
      {
        swal('Blank Field Notice!','Table must have atleast 1 row','error')
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
                $('#rsmiForm').submit();
              } else {
                swal("Cancelled", "Operation Cancelled", "error");
              }
            })
      }
    })

  });
</script>
@endsection