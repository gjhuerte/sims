@extends('backpack::layout')

@section('header')
	<section class="content-header">
	  <h1>
	    Adjustments
	  </h1>
	  <ol class="breadcrumb">
	    <li>Adjustment</li>
	    <li class="active">Home</li>
	  </ol>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box" style="padding:10px">
    <div class="box-body">
      <table class="table table-hover table-striped" id="adjustmentTable" width=100%>
        <thead>
          <tr>
            <th class="col-sm-1">Adjustment No.</th>
            <th class="col-sm-1">Details</th>
            <th class="col-sm-1">Date Created</th>
            <th class="col-sm-1">Created By</th>
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

    var table = $('#adjustmentTable').DataTable({
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
        ajax: "{{ url('adjustment') }}",
        columns: [
                { data: "code" },
                { data: 'details' },
                { data: 'date_created' },
                { data: "created_by" },
                { data: function(callback){

                  ret_val =  `
                    <a href="{{ url('adjustment') }}/`+ callback.id +`" class="btn btn-default btn-sm"><i class="fa fa-list-ul" aria-hidden="true"></i> View</a>
                  `

                    return ret_val;
                } }
        ],
    });

    $('#adjustmentTable').on('click','button.remove',function(){
      var removeButton = $(this);
      removeButton.button('loading');
      $.ajax({
        type: 'delete',
        url: '{{ url("adjustment") }}' + '/' + $(this).data('id'),
        dataType: 'json',
        success: function(response){
          if(response == 'success')
          swal("Operation Success",'Disposal Report has been removed.',"success")
          else
            swal("Error Occurred",'An error has occurred while processing your data.',"error")
            table.ajax.reload()
            removeButton.button('reset');
        },
        error: function(response){
          swal("Error Occurred",'An error has occurred while processing your data.',"error")
        }

      })
    })
  });
</script>
@endsection
