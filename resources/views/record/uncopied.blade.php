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
    record = []

    var table = $('#recordsTable').DataTable({
        serverSide: true,
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
                { data: "received_quantity" },
                { data: "issued_quantity" },
                { data: function(callback){
                  return `<button type="button" data-id="`+callback.id+`" data-date="`+callback.date+`" data-reference="`+callback.reference+`" data-receipt="`+callback.receipt+`" data-organization="`+callback.organization+`" data-stocknumber="`+callback.supply.stocknumber+`" data-received="`+callback.received_quantity+`" data-issued="`+callback.issued_quantity+`" class="copy btn btn-primary btn-sm">Copy</button>`
                } }
        ],
    });

    $('#copy').on('click', function(){
        fundcluster = $('#fundcluster').val()
        unitcost = $('#unitcost').val()

        if (typeof unitcost === 'undefined' || unitcost == null || unitcost == "")
          $('#unitcost').closest('.form-group').removeClass('has-success').addClass('has-error');
        else if (typeof fundcluster === 'undefined' || fundcluster == null || fundcluster == "")
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
              'record' : record,
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
      record = $(this).data()

      if( $(this).data('received') > 0 ) 
        $('#fundcluster-form').show()
      else
        $('#fundcluster-form').hide()
      
      $('#recordFormModal').modal('show')
    })
  });
</script>
@endsection
