@extends('backpack::layout')

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">Supply Ledger</h3></legend>
		<ul class="breadcrumb">
			<li><a href="{{ url('inventory/supply') }}">Supply Inventory</a></li>
			<li><a href="{{ url("inventory/supply/$supply->stocknumber/ledgercard") }}">{{ $supply->stocknumber }}</a></li>
			<li class="active">Accept</li>
		</ul>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box" style="padding:10px;">
    <div class="box-body">
			{{ Form::open(['method'=>'post','route'=>array('supply.ledgercard.store',$supply->stocknumber),'class'=>'col-sm-offset-3 col-sm-6 form-horizontal','id'=>'acceptForm']) }}
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
					{{ Form::label('Reference') }}
					{{ Form::text('reference',Input::old('reference'),[
						'id' => 'reference',
						'class' => 'form-control'
					]) }}
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					{{ Form::label('Receipt Quantity') }}
					{{ Form::number('quantity',Input::old('quantity'),[
						'class' => 'form-control'
					]) }}
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					{{ Form::label('Receipt Unit Price') }}
					{{ Form::number('unitprice',Input::old('unitprice'),[
						'class' => 'form-control'
					]) }}
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					{{ Form::label('No Of Days To Consume') }}
					{{ Form::textarea('daystoconsume',Input::old('daystoconsume'),[
						'class' => 'form-control',
						'rows' => '2'
					]) }}
				</div>
			</div>
			<div class="pull-right">
				<button type="submit" class="btn btn-md btn-success">Accept</button>
				<button type="button" class="btn btn-md btn-default" id="cancel">Cancel</button>
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

			$('#reference').autocomplete({
				source: "{{ url('get/purchaseorder/all') }}"
			})

			$( "#date" ).datepicker({
				  changeMonth: true,
				  changeYear: true,
				  maxAge: 59,
				  minAge: 15,
			});

			$('#cancel').on('click',function(){
				window.location.href = "{{ url("inventory/supply/$supply->stocknumber/ledgercard") }}"
			})

			$('#accept').on('click',function(){
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
		            $('#acceptForm').submit();
		          } else {
		            swal("Cancelled", "Operation Cancelled", "error");
		          }
		        })
			})

			$('#date').on('change',function(){
				setDate("#date");
			});

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
