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
            @if(Auth::user()->access == 1 || Auth::user()->access == 6)
            <th class="col-sm-1">Requestor</th>
            @endif
            <th class="col-sm-1">Remarks</th>
            <th class="col-sm-1">Purpose</th>
            @if(Auth::user()->access == 1 || Auth::user()->access == 6)
            <th class="col-sm-1">Remaining Days</th>
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

    table = $('#requestTable').DataTable({
      pageLength: 25,
      serverSide: true,
      stateSave: true,
      "processing": true,
      language: {
              searchPlaceholder: "Search..."
      },
      columnDefs:[
          { targets: 'no-sort', orderable: false },
      ],
      "order": [
        [0, 'asc']
      ],
      "dom": "<'row'<'col-sm-3'l><'col-sm-6'<'toolbar'>><'col-sm-3'f>>" +
                      "<'row'<'col-sm-12'tr>>" +
                      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
      ajax: "{{ url('request') }}",
      columns: [
        { data: "code" },
        { data: 'date_requested' },
        @if(Auth::user()->access == 1 || Auth::user()->access == 6)
        { data: function(callback){
          if(callback.office) return callback.office.code

          if(callback.requestor) callback.requestor.username
          return null
        } },
        @endif
        { data: "remarks" },
        { data: "purpose" },
        @if(Auth::user()->access == 1 || Auth::user()->access == 6)
        { data: "remaining_days" },
        @endif
        { data: "status" },
        { data: function(callback){
          ret_val = "";

          @if(Auth::user()->access == 1 || Auth::user()->access == 6)
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

    @if(Auth::user()->access == 3)
    $('div.toolbar').html(`
      <a id="create" href="{{ url('request/create') }}" class="btn btn-primary ladda-button" data-style="zoom-in"><span class="ladda-label"><i class="fa fa-plus"></i> Create a Request</span></a>
    `)
    @endif

    @if(Auth::user()->access == 1 || Auth::user()->access == 6)

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
