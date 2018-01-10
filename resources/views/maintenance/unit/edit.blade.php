@extends('backpack::layout')

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">Units</h3></legend>
      <ol class="breadcrumb">
          <li>
              <a href="{{ url('maintenance/unit') }}">Unit</a>
          </li>
          <li class="active">{{ $unit->name }}</li>
          <li class="active">Edit</li>
      </ol>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
        {{ Form::open(array('class' => 'form-horizontal','method'=>'put','route'=>array('unit.update',$unit->id),'id'=>'unitForm')) }}
        <div class="col-md-offset-3 col-md-6" style="padding:10px;">
          @include('errors.alert')
          @include('maintenance.unit.form')
          <div class="pull-right">
            <div class="btn-group">
              <button id="submit" class="btn btn-md btn-primary" type="submit">
                <span class="hidden-xs">Update</span>
              </button>
            </div>
              <div class="btn-group">
                <button id="cancel" class="btn btn-md btn-default" type="button" onClick="window.location.href='{{ url("maintenance/unit") }}'" >
                  <span class="hidden-xs">Cancel</span>
                </button>
              </div>
          </div>
        </div> <!-- centered  -->
        {{ Form::close() }}

    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection