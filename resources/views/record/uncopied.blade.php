@extends('backpack::layout')

@section('after_styles')
<style>
    th , tbody{
      text-align: center;
    }

    th {
      white-space: nowrap;
    }
</style>
@endsection

@section('header')
	<section class="content-header">
	  <h1>
	    Transactions
	  </h1>
	  <ol class="breadcrumb">
	    <li>Transaction</li>
	    <li class="active">Home</li>
	  </ol>
	</section>
@endsection

@section('content')
@include('modal.record.form')
<!-- Default box -->
  <div class="box" style="padding:10px">
    <div class="box-body">
      <table class="table table-hover table-striped" id="recordsTable" width=100%>
        <thead>
          <tr>
            <th class="col-sm-1">ID</th>
            <th class="col-sm-1">Date</th>
            <th class="col-sm-1">Reference</th>
            <th class="col-sm-1">Receipt</th>
            <th class="col-sm-1">Office/Supplier</th>
            <th class="col-sm-1">Stock Number</th>
            <th class="col-sm-1">Details</th>
            <th class="col-sm-1">Received Quantity</th>
            <th class="col-sm-1">Issued Quantity</th>
            <th class="col-sm-1 no-sort"></th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection

@section('after_scripts')
<script>
  jQuery(document).ready(function($) {

    var table = $('#recordsTable').DataTable({
        language: {
                searchPlaceholder: "Search..."
        },
        columnDefs:[
            { targets: 'no-sort', orderable: false },
        ],
        "dom": "<'row'<'col-sm-3'l><'col-sm-6'<'toolbar'>><'col-sm-3'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "processing": true,
        ajax: "{{ url('records/uncopied') }}",
        columns: [
                { data: "id" },
                { data: "date" },
                { data: "reference" },
                { data: "receipt" },
                { data: "organization" },
                { data: "supply.stocknumber" },
                { data: "supply.details" },
                { data: "received_quantity" },
                { data: "issued_quantity" },
                { data: function(callback){
                  return `<button type="button" data-id="`+callback.id+`" data-received="`+callback.received_quantity+`" data-issued="`+callback.issued_quantity+`" data-reference="`+callback.reference+`" data-receipt="`+callback.receipt+`" data-date="`+callback.date+`" data-organization="`+callback.organization+`" data-stocknumber="`+callback.supply.stocknumber+`" data-details="`+callback.supply.details+`" class="copy btn btn-primary btn-sm">Mirror to Ledger Card</button>`
                } }
        ],
    });

    $('#copy-record').on('click', function(){
        fundcluster = $('#fundcluster').val()
        unitcost = $('#unitcost').val()
        id = $('#record-id').val()
        received = $('#record-received').val()
        issued = $('#record-issued').val()

        if (typeof unitcost === 'undefined' || unitcost == null || unitcost == "")
          $('#unitcost').closest('.form-group').removeClass('has-success').addClass('has-error');
        if ((typeof fundcluster === 'undefined' || fundcluster == null || fundcluster == "") && received > 0)
          $('#fundcluster').closest('.form-group').removeClass('has-success').addClass('has-error');
        else
        {
          $('#unitcost').closest('.form-group').removeClass('has-error')
          $('#fundcluster').closest('.form-group').removeClass('has-error')
          $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            async: false, 
            type: 'post',
            url: '{{ url("records/copy") }}',
            dataType: 'json',
            data: {
              'unitcost': unitcost,
              'id' : id,
              'fundcluster': fundcluster
            },
            success: function(response){
              console.log(response)
              $('#recordFormModal').modal('hide')
              if(response == 'success')
                swal('Success','Operation Successful','success')
              else
                swal('Error','Problem Occurred while processing your data','error')
              table.ajax.reload();
            },
            error: function(){
              swal('Error','Problem Occurred while processing your data','error')
            }
          })
        }
    })

    $('#recordsTable').on('click','.copy',function(){
      id = $(this).data('id')
      received = $(this).data('received')
      issued = $(this).data('issued')
      reference = $(this).data('reference')
      receipt = $(this).data('receipt')
      stocknumber = $(this).data('stocknumber')
      organization = $(this).data('organization')
      date = $(this).data('date')
      details = $(this).data('details')

      if(receipt == null) receipt = 'N/A'
      if(organization == null) organization = 'N/A'

      if( received > 0 ) 
        $('#fundcluster-form').show()
      else
        $('#fundcluster-form').hide()

      $('#record-id').val(id)
      $('#record-received').val(received)
      $('#record-issued').val(issued)
      $('#modal-reference').text(reference)
      $('#modal-date').text(date)
      $('#modal-receipt').text(receipt)
      $('#modal-received-quantity').text(received)
      $('#modal-issued-quantity').text(issued)
      $('#modal-stocknumber').text(stocknumber)
      $('#modal-organization').text(organization)
      $('#modal-details').text(details)
      $('#recordFormModal').modal('show')
    })
  });
</script>
@endsection
