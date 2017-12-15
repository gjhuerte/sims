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
      <table class="table table-hover table-striped" id="requestTable" width=100%>
        <thead>
          <tr>
            <th class="col-sm-1">Request No.</th>
            <th class="col-sm-1">Request Date</th>
            @if(Auth::user()->access == 1)
            <th class="col-sm-1">Requestor</th>
            @endif
            <th class="col-sm-1">Remarks</th>
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

    var table = $('#requestTable').DataTable({
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
        ajax: "{{ url('request') }}",
        columns: [
                { data: "code" },
                { data: function(callback){
                    return moment(callback.created_at).format("MMMM D, YYYY")
                } },
                @if(Auth::user()->access == 1)
                { data: "office" },
                @endif
                { data: "remarks" },
                { data: "status" },
                { data: function(callback){
                  ret_val = "";

                  @if(Auth::user()->access == 1)
                  if(!callback.status)
                  {
                    ret_val += `
                      <a type="button" href="{{ url('request') }}/`+callback.id+`/approve" data-id="`+callback.id+`" class="approve btn btn-success btn-sm">
                          <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                      </a>
                      <button type="button" data-id="`+callback.id+`" class="disapprove btn btn-danger btn-sm">
                        <i class="fa fa-thumbs-down" aria-hidden="true"></i>
                      </button>
                    `
                  }
                  @endif

                  ret_val +=  `
                    <a href="{{ url('request') }}/`+ callback.id +`" class="btn btn-default btn-sm"><i class="fa fa-list-ul" aria-hidden="true"></i> View</a>
                  `

                    return ret_val;
                } }
        ],
    });

    $('div.toolbar').html(`
      <a id="create" href="{{ url('request/create') }}" class="btn btn-primary ladda-button" data-style="zoom-in"><span class="ladda-label"><i class="fa fa-plus"></i> Create a Request</span></a>
    `)

    @if(Auth::user()->access == 1)

    $('#requestTable').on('click','.disapprove',function(){
        id = $(this).data('id')
        swal({
              title: "Remarks!",
              text: "Input reason for disapproving the request",
              type: "input",
              showCancelButton: true,
              closeOnConfirm: false,
              animation: "slide-from-top",
              inputPlaceholder: "Write something"
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
                type: 'put',
                url: '{{ url("request") }}' + "/" + id + '/disapprove',
                data: {
                    'reason': inputValue
                },
                dataType: 'json',
                success: function(response){
                    if(response == 'success'){
                        swal('Operation Successful','Operation Complete','success')
                        table.ajax.reload();
                    }else{
                        swal('Operation Unsuccessful','Error occurred while processing your request','error')
                    }

                },
                error: function(){
                    swal('Operation Unsuccessful','Error occurred while processing your request','error')
                }
            })
        })
    });

    @endif
  });
</script>
@endsection
