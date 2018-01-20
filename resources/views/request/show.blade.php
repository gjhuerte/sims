@extends('backpack::layout')

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">{{ $request->code }}</h3></legend>
		<ul class="breadcrumb">
			<li><a href="{{ url('request') }}">Request</a></li>
			<li class="active"> {{ $request->code }} </li>
		</ul>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
		<div class="panel panel-body table-responsive">
			@if(isset($request->requestor_id) && Auth::user()->id == $request->requestor_id && $request->status == null)
        <a href="{{ url("request/$request->id/edit") }}" class="btn btn-default btn-sm">
	    		<i class="fa fa-pencil" aria-hidden="true"></i> Edit
	    	</a>
        <a href="{{ url("request/$request->id/cancel") }}" class="btn btn-danger btn-sm">
        	<i class="fa fa-hand-stop-o" aria-hidden="true"></i> Cancel
        </a>
        <hr />
      @endif

			<table class="table table-hover table-striped table-bordered table-condensed" id="requestTable" cellspacing="0" width="100%"	>
				<thead>
          <tr rowspan="2">
              <th class="text-left" colspan="3">Request Slip:  <span style="font-weight:normal">{{ $request->code }}</span> </th>
              <th class="text-left" colspan="3">Requestor:  <span style="font-weight:normal">{{ isset($request->office) ? $request->office->code : 'None' }}</span> </th>
          </tr>
          <tr rowspan="2">
              <th class="text-left" colspan="3">Remarks:  <span style="font-weight:normal">{{ $request->remarks }}</span> </th>
              <th class="text-left" colspan="3">Status:  <span style="font-weight:normal">{{ ($request->status == '') ? ucfirst(config('app.default_status')) : $request->status }}</span> </th>
          </tr>
          <tr rowspan="2">
              <th class="text-left" colspan="6">Purpose:  <span style="font-weight:normal">{{ $request->purpose }}</span> </th>
          </tr>
          <tr>
						<th>Stock Number</th>
						<th>Details</th>
						<th>Quantity Requested</th>
						<th>Quantity Issued</th>
						<th>Quantity Released</th>
						<th>Notes</th>
					</tr>
				</thead>
			</table>
		</div>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection

@section('after_scripts')

<script>
	$(document).ready(function() {

    var table = $('#requestTable').DataTable({
			language: {
					searchPlaceholder: "Search..."
			},
			"dom": "<'row'<'col-sm-3'l><'col-sm-6'<'toolbar'>><'col-sm-3'f>>" +
							"<'row'<'col-sm-12'tr>>" +
							"<'row'<'col-sm-5'i><'col-sm-7'p>>",
			"processing": true,
			ajax: "{{ url("request/$request->id") }}",
			columns: [
					{ data: "stocknumber" },
					{ data: "details" },
					{ data: "pivot.quantity_requested" },
					{ data: "pivot.quantity_issued" },
					{ data: "pivot.quantity_released" },
					{ data: "pivot.comments" }
			],
    });

    $('div.toolbar').html(`
         <a href="{{ url("request/$request->id/print") }}" target="_blank" id="print" class="print btn btn-sm btn-default ladda-button" data-style="zoom-in">
          <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
          <span id="nav-text"> Print</span>
        </a>
        @if($request->status == 'approved' && Auth::user()->access == 1)
        <a id="release" href="{{ url("request/$request->id/release") }}" class="btn btn-sm btn-danger ladda-button" data-style="zoom-in">
          <span class="ladda-label"><i class="glyphicon glyphicon-share-alt"></i> Release</span>
        </a>
        @endif
        <a id="comment" href="{{ url("request/$request->id/comments") }}" class="btn btn-sm btn-primary ladda-button" data-style="zoom-in">
          <span class="ladda-label"><i class="fa fa-comment" aria-hidden="true"></i> Commentary</span>
        </a>

        @if(Auth::user()->access == 1)

          @if($request->status == null)
          <a type="button" href="{{ url("request/$request->id/approve") }}" data-id="{{ $request->id }}" class="approve btn btn-success btn-sm">
              <i class="fa fa-thumbs-up" aria-hidden="true"> Approve</i>
          </a>
          <button id="disapprove" type="button" data-id="{{ $request->id }}" class="btn btn-danger btn-sm">
            <i class="fa fa-thumbs-down" aria-hidden="true"> Disapprove</i>
          </button>
          @endif

          @if($request->status != null && $request->status != 'released')
          <button id="reset" type="button" data-id="{{ $request->id }}" class="btn btn-warning btn-sm">
            <i class="fa fa-refresh" aria-hidden="true"> Reset Status</i>
          </button>

          @endif

        @endif
    `)
    @if(Auth::user()->access == 1 )

    @if($request->status == null)
    $('#disapprove').on('click',function(){
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
                url: '{{ url("request/$request->id/disapprove") }}',
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

    @if($request->status != null && $request->status != 'released')

    $('#reset').on('click',function(){
      id = $(this).data('id');
      swal({
        title: 'Reset Status of Request {{ $request->code }}',
        text: 'This will set the status of the current request to pending. Any modification to request will be reset. Do you want to continue?',
        type: 'warning',
        showLoaderOnConfirm: true,
        showCancelButton: true,
        closeOnConfirm: false,
        disableButtonsOnConfirm: true,
        confirmLoadingButtonColor: '#DD6B55'
      }, function(){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'put',
            url: '{{ url("request/$request->id/reset") }}',
            data: {
                'id': id
            },
            dataType: 'json',
            success: function(response){
                if(response == 'success'){
                    swal('Operation Successful','Operation Complete please reload the page!','success')
                }else{
                    swal('Operation Unsuccessful','Error occurred while processing your request','error')
                }
            },
            error: function(){
                swal('Operation Unsuccessful','Error occurred while processing your request','error')
            }
        })
      });
    });

    @endif

    @endif

	} );
</script>
@endsection
