@extends('backpack::layout')

@section('header')
	<section class="content-header">
	  <h1>
	    Request
	  </h1>
	  <ol class="breadcrumb">
	    <li>Request</li>
	    <li class="active">Home</li>
	  </ol>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box" style="padding:10px">
    <div class="box-body">
      <table class="table table-hover table-striped" id="disposalTable" width=100%>
        <thead>
          <tr>
            <th class="col-sm-1">Disposal No.</th>
            <th class="col-sm-1">Date Created</th>
            @if(Auth::user()->access == 1)
            <th class="col-sm-1">Created By</th>
            @endif
            <th class="col-sm-1">Status</th>
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

    var table = $('#disposalTable').DataTable({
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
        ajax: "{{ url('disposal') }}",
        columns: [
                { data: "code" },
                { data: 'date_created' },
                { data: "created_by" },
                { data: "status" },
                { data: function(callback){

                  ret_val =  `
                    <a href="{{ url('disposal') }}/`+ callback.id +`" class="btn btn-default btn-sm"><i class="fa fa-list-ul" aria-hidden="true"></i> View</a>
                    <a href="{{ url('disposal') }}/`+ callback.id +`/edit" class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                    <button type="button" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Removing Category" data-id="`+callback.id+`" class="remove btn btn-sm btn-danger">Remove</button>
                  `

                    return ret_val;
                } }
        ],
    });

    $('div.toolbar').html(`
      <a id="create" href="{{ url('disposal/create') }}" class="btn btn-primary ladda-button" data-style="zoom-in"><span class="ladda-label"><i class="fa fa-plus"></i> Create a Disposal Report</span></a>
    `)

    $('#disposalTable').on('click','button.remove',function(){
      var removeButton = $(this);
      removeButton.button('loading');
      $.ajax({
        type: 'delete',
        url: '{{ url("disposal") }}' + '/' + $(this).data('id'),
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
