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
            <th class="col-sm-1">Unit</th>
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
                { data: "supply.unit" },
                { data: "received" },
                { data: "issued" },
                { data: function(callback){
                  return `<button type="button" data-id="`+callback.id+`" data-date="`+callback.date+`" data-reference="`+callback.reference+`" data-receipt="`+callback.receipt+`" data-organization="`+callback.organization+`" data-stocknumber="`+callback.supply.stocknumber+`" data-details="`+callback.supply.details+`" data-unit="`+callback.supply.unit+`" data-received="`+callback.received+`" data-issued="`+callback.issued+`" class="copy btn btn-primary btn-sm">Copy</button>`
                } }
        ],
    });

    $('#recordsTable').on('click','.copy',function(){
      record = $(this).data()

      swal({
        title: "Purchase Order",
        text: "Input Price (Php):",
        type: "input",
        showCancelButton: true,
        closeOnConfirm: false,
        animation: "slide-from-top",
        inputPlaceholder: "Php XX.XX"
      },
      function(inputValue){
        if (inputValue === false) return false;

        if (inputValue === "") {
          swal.showInputError("You need to write something!");
          return false
        }

        $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'post',
          url: '{{ url("records/copy") }}',
          dataType: 'json',
          data: {
            'unitprice': inputValue,
            'record' : record
          },
          success: function(response){
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
      });
    })
  });
</script>
@endsection
