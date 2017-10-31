@extends('backpack::layout')

@section('after_styles')
    <!-- Ladda Buttons (loading buttons) -->
    <link href="{{ asset('vendor/backpack/ladda/ladda-themeless.min.css') }}" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
		{{ HTML::style(asset('css/select.bootstrap.min.css')) }}
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
		</style>

    <!-- Bootstrap -->
    {{ HTML::style(asset('css/jquery-ui.css')) }}
    {{ HTML::style(asset('css/sweetalert.css')) }}
    {{ HTML::style(asset('css/dataTables.bootstrap.min.css')) }}
@endsection

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">Stock Card</h3></legend>
		<ul class="breadcrumb">
			<li><a href="{{ url('inventory/supply') }}">Supply Inventory</a></li>
			<li><a href="{{ url("inventory/supply/$supply->stocknumber/stockcard") }}">{{ $supply->stocknumber }}</a></li>
			<li class="active">Release</li>
		</ul>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box" style="padding:10px;">
    <div class="box-body">
       {{ Form::open(['method'=>'delete','route'=>array('supply.stockcard.destroy',$supply->stocknumber,$supply->stocknumber),'class'=>'form-horizontal','id'=>'releaseForm']) }}
		        @if (count($errors) > 0)
		            <div class="alert alert-danger alert-dismissible" role="alert">
		            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                <ul style='margin-left: 10px;'>
		                    @foreach ($errors->all() as $error)
		                        <li>{{ $error }}</li>
		                    @endforeach
		                </ul>
		            </div>
		        @endif
				<div class="panel panel-info" style="border:none;border-radius: 0px;;">
          <div class="panel-heading" style="padding:10px;">
            Item Information
          </div>
					<div class="panel-body">
						<ul class="list-unstyled text-muted">
							<li><strong>Entity Name:</strong> {{ $supply->entityname }}</li>
							<li><strong>Item:</strong> {{ $supply->supplytype }}</li>
							<li><strong>Fund Cluster:</strong> {{ $supply->fundcluster }}</li>
						</ul>
					</div>
				</div>
				<input type="hidden" value="{{ $supply->stocknumber }}" name="stocknumber" />
				<div class="col-md-12">
					<div class="form-group">
						{{ Form::label('Date') }}
						{{ Form::text('date',Input::old('date'),[
							'id' => 'date',
							'class' => 'form-control',
							'readonly',
							'style' => 'background-color: white;'
						]) }}
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						{{ Form::label('Requisition and Issue Slip') }}
						{{ Form::text('requisitionissueslip',Input::old('requisitionissueslip'),[
							'class' => 'form-control'
						]) }}
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						{{ Form::label('Office') }}
						{{ Form::text('office',Input::old('office'),[
							'id' => 'office',
							'class' => 'form-control'
						]) }}
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						{{ Form::label('Issue Quantity') }}
						{{ Form::number('quantity',Input::old('quantity'),[
							'id' => 'quantity',
							'class' => 'form-control'
						]) }}
						<p class="text-danger">Remaining Balance: <span id="balance">{{ $balance }}</span></p>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						{{ Form::label('Days To Consume') }}
						{{ Form::textarea('daystoconsume',Input::old('daystoconsume'),[
							'class' => 'form-control',
							'rows' => '2'
						]) }}
					</div>
				</div>
				<div class="pull-right">
					<button type="button" id="release" class="btn btn-md btn-danger">Release</button>
					<button type="button" id="cancel" class="btn btn-md btn-default">Cancel</button>
				</div>
				{{ Form::close() }}

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
		$('document').ready(function(){

			$('#cancel').on('click',function(){
				window.location.href = "{{ url("inventory/supply/$supply->stocknumber/stockcard") }}"
			})

			$('#release').on('click',function(){
		        swal({
		          title: "Are you sure?",
		          text: "This will no longer be editable once submitted. Do you want to continue?",
		          type: "warning",
		          showCancelButton: true,
		          confirmButtonText: "Yes, submit it!",
		          cancelButtonText: "No, cancel it!",
		          closeOnConfirm: false,
		          closeOnCancel: false
		        },
		        function(isConfirm){
		          if (isConfirm) {
		            $('#releaseForm').submit();
		          } else {
		            swal("Cancelled", "Operation Cancelled", "error");
		          }
		        })
			})

			url = "{{ url('get/office/code') }}"

			$( "#date" ).datepicker({
				  changeMonth: true,
				  changeYear: true,
				  maxAge: 59,
				  minAge: 15,
			});

			$('#office').autocomplete({
				source: url
			})

			$('#date').on('change',function(){
				setDate("#date");
			});

			$('#quantity').on('change',function(){
				_const = {{ ($balance) ? $balance: 0 }};
				balance = _const - $('#quantity').val()
				$('#balance').text(balance)
			})

			@if(Input::old('date'))
				$('#date').val('{{ Input::old('date') }}');
				setDate("#date");
			@else
				$('#date').val('{{ Carbon\Carbon::now()->toFormattedDateString() }}');
				setDate("#date");
			@endif

			function setDate(object){
					var object_val = $(object).val()
					var date = moment(object_val).format('MMM DD, YYYY');
					$(object).val(date);
			}

			@if( Session::has("success-message") )
				swal("Success!","{{ Session::pull('success-message') }}","success");
			@endif

			@if( Session::has("error-message") )
				swal("Oops...","{{ Session::pull('error-message') }}","error");
			@endif

			$('#page-body').show()
		})
</script>
@endsection
