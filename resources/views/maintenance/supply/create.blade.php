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
		</style>

    <!-- Bootstrap -->
    {{ HTML::style(asset('css/jquery-ui.css')) }}
    {{ HTML::style(asset('css/sweetalert.css')) }}
    {{ HTML::style(asset('css/dataTables.bootstrap.min.css')) }}
@endsection

@section('header')
	<section class="content-header">
      <legend><h3 class="text-muted">Supplies</h3></legend>
      <ul class="breadcrumb">
        <li><a href="{{ url('maintenance/supply') }}">Supply</a></li>
        <li class="active">Add</li>
      </ul>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box" style="padding:10px;">
    <div class="box-body">
			{{ Form::open(['method'=>'post','route'=>array('supply.store'),'class'=>' col-sm-offset-3 col-sm-6 form-horizontal']) }}
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
			<div class="col-md-12">
				<div class="form-group">
					{{ Form::label('Stock Number') }}
					{{ Form::text('stocknumber',Input::old('stocknumber'),[
						'class' => 'form-control'
					]) }}
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					{{ Form::label('Entity Name') }}
					{{ Form::text('entityname',"Polytechnic University Of the Philippines",[
						'class' => 'form-control',
						'readonly'
					]) }}
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					{{ Form::label('Supply Type') }}
					{{ Form::text('supplytype',Input::old('item'),[
						'id' => 'item',
						'class' => 'form-control'
					]) }}
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					{{ Form::label('Unit Of Measurement') }}
					{{ Form::text('unit',Input::old('unit'),[
						'class' => 'form-control'
					]) }}
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					{{ Form::label('Reorder Point') }}
					{{ Form::number('reorderpoint',Input::old('reorderpoint'),[
						'class' => 'form-control'
					]) }}
				</div>
			</div>
      <div class="pull-right">
        <div class="btn-group">
          <button id="submit" class="btn btn-md btn-primary" type="submit">
            <span class="hidden-xs">Submit</span>
          </button>
        </div>
          <div class="btn-group">
            <button id="cancel" class="btn btn-md btn-default" type="button" onClick="window.location.href='{{ url("maintenance/supply") }}'" >
              <span class="hidden-xs">Cancel</span>
            </button>
          </div>
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

<script>
	$(document).ready(function() {

		@if( Session::has("success-message") )
			swal("Success!","{{ Session::pull('success-message') }}","success");
		@endif
		@if( Session::has("error-message") )
			swal("Oops...","{{ Session::pull('error-message') }}","error");
		@endif

		$('#page-body').show();
	} );
</script>
@endsection
