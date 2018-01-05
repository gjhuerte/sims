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
		{{ Form::open(['method'=>'put','route'=>array('supply.update',$supply->id),'class'=>'col-sm-offset-3 col-sm-6 form-horizontal']) }}
		@include('errors.alert')
		@include('maintenance.supply.form')
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
