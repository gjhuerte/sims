@extends('backpack::layout')

@section('header')
	<section class="content-header">
      <legend><h3 class="text-muted">Supplies</h3></legend>
      <ul class="breadcrumb">
        <li><a href="{{ url('maintenance/supply') }}">Supply</a></li>
        <li class="active">{{ $supply->stocknumber }}</li>
        <li class="active">Edit</li>
      </ul>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box" style="padding:10px;">
    <div class="box-body">
			{{ Form::open(['method'=>'put','route'=>array('supply.update',$supply->stocknumber),'class'=>'col-sm-offset-3 col-sm-6 form-horizontal']) }}
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
					{{ Form::text('stocknumber',isset($supply->stocknumber) ? $supply->stocknumber : Input::old('stocknumber'),[
						'id' => 'stocknumber',
						'class' => 'form-control'
					]) }}
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					{{ Form::label('Details') }}
					{{ Form::text('details',isset($supply->details) ? $supply->details : Input::old('details'),[
						'id' => 'details',
						'class' => 'form-control'
					]) }}
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					{{ Form::label('Unit Of Measurement') }}
					{{ Form::select('unit',$unit,isset($supply->unit) ? $supply->unit : Input::old('unit'),[
						'id' => 'unit',
						'class' => 'form-control'
					]) }}
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					{{ Form::label('Reorder Point') }}
					{{ Form::number('reorderpoint',isset($supply->reorderpoint) ? $supply->reorderpoint : Input::old('reorderpoint'),[
						'id' => 'reorderpoint',
						'class' => 'form-control'
					]) }}
				</div>
			</div>
      <div class="pull-right">
        <div class="btn-group">
          <button id="submit" class="btn btn-md btn-primary" type="submit">
            <span class="hidden-xs">Update</span>
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
