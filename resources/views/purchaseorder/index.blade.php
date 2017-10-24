@extends('backpack::layout')

@section('after_styles')
    <!-- Ladda Buttons (loading buttons) -->
    <link href="{{ asset('vendor/backpack/ladda/ladda-themeless.min.css') }}" rel="stylesheet" type="text/css" />
  	<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  	<style>
  		#page-body{
  			display: none;
  		}

  		a > hover{
  			text-decoration: none;
  		}

  		th , tbody{
  			text-align: center;
  		}

  		td{
  			font-size: 12px;
  		}
  	</style>

    <!-- Bootstrap -->
    {{ HTML::style(asset('css/jquery-ui.css')) }}
    {{ HTML::style(asset('css/sweetalert.css')) }}
    {{ HTML::style(asset('css/dataTables.bootstrap.min.css')) }}
@endsection

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">Purchase Order</h3></legend>
	  {{-- <ol class="breadcrumb">
	    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/dashboard') }}">Das</a></li>
	    <li class="active">{{ trans('backpack::backup.backup') }}</li>
	  </ol> --}}
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
		<div class="panel panel-body table-responsive">
			<table class="table table-hover table-striped" id="purchaseOrderTable">
				<thead>
					<th>P.O. Number / APR</th>
					<th>Date</th>
					<th>Fund Cluster</th>
					<th>Details</th>
					@if(Auth::user()->accesslevel == 2)
					<th class="col-md-2"></th>
					@endif
				</thead>
			</table>
		</div>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection

@section('after_scripts')
    <!-- Ladda Buttons (loading buttons) -->
    <script src="{{ asset('vendor/backpack/ladda/spin.js') }}"></script>
    <script src="{{ asset('vendor/backpack/ladda/ladda.js') }}"></script>

    {{ HTML::script(asset('js/jquery-ui.js')) }}
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    {{ HTML::script(asset('js/sweetalert.min.js')) }}
    {{ HTML::script(asset('js/jquery.dataTables.min.js')) }}
    {{ HTML::script(asset('js/dataTables.bootstrap.min.js')) }}
    {{ HTML::script(asset('js/moment.min.js')) }}

<script>
	$(document).ready(function() {

		@if( Session::has("success-message") )
			swal("Success!","{{ Session::pull('success-message') }}","success");
		@endif
		@if( Session::has("error-message") )
			swal("Oops...","{{ Session::pull('error-message') }}","error");
		@endif

	    var table = $('#purchaseOrderTable').DataTable({
			select: {
				style: 'single'
			},
			language: {
					searchPlaceholder: "Search..."
			},
	    	columnDefs:[
				{ targets: 'no-sort', orderable: false },
	    	],

			@if(Auth::user()->accesslevel == 2)
			"dom": "<'row'<'col-sm-3'l><'col-sm-6'<'toolbar'>><'col-sm-3'f>>" +
							"<'row'<'col-sm-12'tr>>" +
							"<'row'<'col-sm-5'i><'col-sm-7'p>>",
			@endif
			"processing": true,
			ajax: "{{ url('purchaseorder') }}",
			columns: [
					{ data: "purchaseorderno" },
					{ data: function(callback){
						return moment(callback.date).format("MMMM d, YYYY")
					} },
					{ data: "fundcluster" },
					{ data: "details" }
					@if(Auth::user()->accesslevel == 2)
					,{ data: function(callback){
						url = '{{ url("purchaseorder") }}' + '/' + callback.purchaseorderno
						return `
							<a type='button' href='` + url + `' class='btn btn-default btn-sm'>View</a>
							<button type='button' data-id='` + url + `' data-fundcluster='` + callback.fundcluster + `' class='fundcluster btn btn-info btn-sm'>Fund Cluster</button>
							`
					} }
					@endif
			],
	    });

	 	$("div.toolbar").html(`
			<button id="create" class="btn btn-md btn-primary">
				<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				<span id="nav-text"> Create</span>
			</button>
		`);

		$('#create').on('click',function(){
			window.location.href = "{{ url('purchaseorder/create') }}"
		})

	    $('#purchaseOrderTable').on('click','.fundcluster',function(){
	    	url = "";
	    	id = $(this).data('id')
	    	fundcluster = $(this).data('fundcluster')
	    	swal({
			  title: "Input Fund Cluster!",
			  text: "If multiple, comma separate each fund cluster:",
			  type: "input",
			  showCancelButton: true,
			  closeOnConfirm: false,
			  animation: "slide-from-top",
			  inputValue: fundcluster
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
			  	url: id,
			  	dataType: 'json',
			  	data: {
			  		'fundcluster': inputValue
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

		$('#page-body').show();
	} );
</script>
@endsection
