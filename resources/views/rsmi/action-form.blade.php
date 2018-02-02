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

<form method="post" action="{{ url("rsmi/$rsmi->id/receive") }}" id="rsmiForm">

  <input type="hidden" name="_token" value="{{ csrf_token() }}" />

  <!-- Stock Card Table -->
  <div class="col-sm-12" style="padding: 10px;">
    <h3 class="line-either-side text-muted">RSMI List</h3>

    <table class="table table-hover table-condensed table-striped table-bordered" id="supplyTable" style="padding:20px;margin-right: 10px;">
      <thead>
          <th class="col-sm-1">Reference</th>
          <th class="col-sm-1">Stock Number</th>
          <th class="col-sm-1">Details</th>
          <th class="col-sm-1">Issued Quantity</th>
          <th class="col-sm-1">Unit Cost</th>
          <th class="col-sm-1">Status</th>
      </thead>
      <tbody>
      @if(isset($rsmi->stockcards))
          @foreach($rsmi->stockcards as $stockcard)

            {{-- checks whether the item should have a display error --}}
            @php
              $stockcard_id = $stockcard->pivot->stockcard_id;
            @endphp

            @if( old("unitcost.$stockcard_id") ) 

              @if( old("unitcost.$stockcard_id") <= 0 )
              <tr class="danger"> 
              @endif

            @elseif( $stockcard->supply->unitcost == 0.00  || $stockcard->supply->unitcost == null || $stockcard->supply->unitcost == "" ) 
            <tr class="warning"> 
            @endif
            {{-- checks whether the item should have a display error --}}

            <td>
              {{ $stockcard->reference }}
              <input type="hidden" name="reference[{{ $stockcard->pivot->stockcard_id }}]" class="form-control" value="{{ $stockcard->reference }}"  />
            </td>
            <td> 
              {{ $stockcard->supply->stocknumber }}
              <input type="hidden" class="stocknumber form-control" name="stocknumber[{{ $stockcard->pivot->stockcard_id }}]" value="{{ $stockcard->supply->stocknumber }}" data-stocknumber="{{ $stockcard->supply->stocknumber }}" readonly style="background-color: white;border: none;" />
            </td>
            <td>{{ $stockcard->supply->details }}</td>
            <td>
              <input type="number" name="quantity[{{ $stockcard->pivot->stockcard_id }}]" class="form-control" value="{{ $stockcard->issued_quantity }}" readonly style="background-color: white; border: none;" />
            </td>
            <td>
              <input type="text" name="unitcost[{{ $stockcard->pivot->stockcard_id }}]" data-id="{{ $stockcard->pivot->stockcard_id }}" class="unitcost form-control" value="{{ old("unitcost.$stockcard_id") ? old("unitcost.$stockcard_id") : number_format($stockcard->supply->unitcost, 2) }}" />
            </td>
            <td>
              <input type="hidden" name="id[]" class="stockcard-id" value="{{ $stockcard->pivot->stockcard_id }}"  />
              <div class="status"></div>
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
        <button type="button" id="approve" class="btn btn-md btn-success">Receive</button>
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

    $('#supplyTable').on('change keyup', '.unitcost', function(event){
      rsmi = {{ $rsmi->id }}
      stockcard_id = $(event.target).data('id')

      updateToAll = `<button type="button" data-rsmi="`+rsmi+`"  data-stockcard="`+stockcard_id+`" class="btn btn-warning btn-sm append">Append to similar stock </button>`

      html = `<div class="form-group">`+updateToAll+`</div>`
      $(event.target).closest('tr').find(".status").html(html)
    })

    $('#supplyTable').on('click', '.save', function(event){
      rsmi = $(event.target).data('rsmi')
      stockcard = $(event.target).data('stockcard')
      unitcost = $(event.target).closest('tr').find(".unitcost").val()

      
    })

    $('#supplyTable').on('click', '.append', function(event){
      rsmi = $(event.target).data('rsmi')
      stockcard = $(event.target).data('stockcard')
      unitcost = $(event.target).closest('tr').find(".unitcost").val()

      stocknumber = $(event.target).closest('tr').find('input[name^=stocknumber]').data('stocknumber')

      $('input[name^=stocknumber][value="'+stocknumber+'"]').each(function(key, item){
        $('input[name="'+this.name+'"]').closest('tr').find(".unitcost").val(unitcost)
      })

      $(event.target).closest('tr').find(".status").html(``)

    })

  });
</script>
@endsection