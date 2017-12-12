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
        {{ Form::open(array('class' => 'col-md-offset-3 col-md-6  form-horizontal','method'=>'put','route'=>array('unit.update',$unit->id),'id'=>'unitForm')) }}
        <div class="" style="padding:10px;">
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
        <div class="form-group">
          <div class="col-md-12">
            {{ Form::label('name','Name') }}
            {{ Form::text('name',(Input::old('name')) ? Input::old('name') : $unit->name ,[
              'class'=>'form-control',
              'placeholder'=>'Name'
            ]) }}
          </div>
        </div>
          <div class="form-group">
            <div class="col-md-12">
              {{ Form::label('abbreviation','Abbreviation') }}
              {{ Form::text('abbreviation',Input::old('abbreviation') ? Input::old('abbreviation') : $unit->abbreviation,[
                'class'=>'form-control',
                'placeholder'=>'abbreviation'
              ]) }}
            </div>
          </div>
        <div class="form-group">
          <div class="col-md-12">
            {{ Form::label('description','Description') }}
            {{ Form::text('description', (Input::old('description')) ? Input::old('description') : $unit->description ,[
              'class'=>'form-control',
              'placeholder'=>'Description'
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