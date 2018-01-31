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

<!-- Stock Card Table -->
<div class="col-sm-12" style="padding: 10px;">
  <h3 class="line-either-side text-muted">RSMI List</h3>
  <table class="table table-hover table-condensed table-striped table-bordered" id="supplyTable" style="padding:20px;margin-right: 10px;">
    <thead>
      <tr>
        <th class="col-sm-1">Reference</th>
        <th class="col-sm-1">Stock Number</th>
        <th class="col-sm-1">Details</th>
        <th class="col-sm-1">Issued Quantity</th>
        <th class="col-sm-1">Unit Cost</th>
        <th class="col-sm-1">Status</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td colspan=6 class="text-muted text-center"> ** Nothing Follows **</td>
      </tr>
    </tbody>
  </table>
</div> <!-- end of Stock Card Table -->  

  <!-- action buttons -->
  <div class="pull-right">
    <div class="btn-group">
      <button type="button" id="approve" class="btn btn-md btn-success btn-block">Receive</button>
    </div>
    <div class="btn-group">
        <a type="button" id="cancel" class="btn btn-md btn-default" href="{{ url("rsmi/$rsmi->id") }}">Cancel</a>
    </div>
  </div> <!-- end of action buttons -->
</div> <!-- end of buttons -->

@section('after_scripts')

<script>
  jQuery(document).ready(function($) {

    $('#approve').on('click',function(){

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
                $('#rsmiForm').submit();
              } else {
                swal("Cancelled", "Operation Cancelled", "error");
              }
            })
      }
    })

    function insertRow(id, reference, stocknumber, issued=0, unitcost=0)
    {

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
                  `+id+` <input type="hidden" name="id[]" class="stockcard-id" value="`+id+`"  />
                  <td>`+reference+`
                    <input type="hidden" name="reference[`+id+`]" class="form-control" value="`+reference+`"  />
                  </td>
                  <td> 
                    <input type="text" class="stocknumber form-control" name="stocknumber[`+id+`]" value="`+response.data.stocknumber+`" data-stocknumber="`+response.data.stocknumber+`" readonly style="background-color: white;border: none;" />
                  </td>
                  <td>`+response.data.details+`</td>
                  <td>
                    <input type="number" name="quantity[`+id+`]" class="form-control" value="`+issued+`"  />
                  </td>
                  <td>
                    <input type="number" name="unitcost[`+id+`]" data-id="`+id+`" class="unitcost form-control" value="`+unitcost+`" />
                  </td>
                  <td>
                    <div class="status"></div>
                  </td>
                </tr>
            `)

        }
      })
    }

    $('#supplyTable').on('change keyup', '.unitcost', function(event){
      rsmi = {{ $rsmi->id }}
      stockcard_id = $(event.target).data('id')

      updateToAll = `<button type="button" data-rsmi="`+rsmi+`"  data-stockcard="`+stockcard_id+`" class="btn btn-warning btn-sm append">Append to similar stock </button>`
      save = `<button type="button" data-rsmi="`+rsmi+`"  data-stockcard="`+stockcard_id+`" class="btn btn-primary btn-sm save">Save</button><br/ ><p class="text-success" style="font-size: 12px;">Double Click to Apply Changes</p>`

      html = `<div class="form-group">`+updateToAll+` ` + save+`</div>`
      $(event.target).closest('tr').find(".status").html(updateToAll + save)
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
        console.log(this.name)
        $('input[name="'+this.name+'"]').closest('tr').find(".unitcost").val(unitcost)
      })

      $(event.target).closest('tr').find(".status").html(``)

      // $('input[name=unitcost['+stockcard+']]').val(unitcost)

      // $.ajax({
      //   headers: {
      //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      //   },
      // })

      // $('input[name=unitcost['+id+']]')
      // $(event.target).closest('tr').find(".status").text('Saved')
    })

  @if(isset($rsmi->stockcards))
      @foreach($rsmi->stockcards->take(10) as $stockcard)
      insertRow("{{ $stockcard->pivot->stockcard_id }}", "{{ $stockcard->reference }}", "{{ $stockcard->supply->stocknumber }}", "{{ $stockcard->issued_quantity }}", "{{ number_format($stockcard->supply->unitcost, 2) }}")
    @endforeach
  @else
    @if(null !== old('stocknumber'))
      @foreach(old('stocknumber') as $stocknumber)
        insertRow("{{ $stocknumber }}", "{{ old("rsmied.$stocknumber") }}",  "{{ old("quantity.$stocknumber") }}")
      @endforeach
    @endif
  @endif

  });
</script>
@endsection