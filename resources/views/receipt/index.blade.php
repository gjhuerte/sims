@extends('backpack::layout')

@section('after_styles')
<style>
    th , tbody{
      text-align: center;
    }
</style>
@endsection

@section('header')
	<section class="content-header">
	  <h1>
	    Receipt
	  </h1>
	  <ol class="breadcrumb">
	    <li>Receipt</li>
	    <li class="active">Home</li>
	  </ol>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box" style="padding:10px">
    <div class="box-body">
      <table class="table table-hover table-striped" id="receiptTable" width=100%>
        <thead>
          <tr>
            <th class="col-sm-1">ID</th>
            <th class="col-sm-1">Receipt Number</th>
            <th class="col-sm-1">Invoice</th>
            <th class="col-sm-1">Supplier</th>
            <th class="col-sm-1">Date Delivered</th>
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

    var table = $('#receiptTable').DataTable({
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
        ajax: "{{ url('receipt') }}",
        columns: [
                { data: "id" },
                { data: "number" },
                { data: "invoice" },
                { data: "supplier_name" },
                { data: function(callback){
                    return moment(callback.date_delivered).format("MMMM D, YYYY")
                } },
                { data: function(callback){
                  ret_val = "";

                  ret_val +=  `
                    <a href="{{ url('receipt') }}/`+ callback.number +`" class="btn btn-default btn-sm"><i class="fa fa-list-ul" aria-hidden="true"></i> View</a>
                  `

                    return ret_val;
                } }
        ],
    });
  });
</script>
@endsection
