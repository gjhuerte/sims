@extends('backpack::layout')

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">Offices</h3></legend>
      <ol class="breadcrumb">
          <li>
              <a href="{{ url('maintenance/office') }}">Office</a>
          </li>
          <li class="active">{{ $office->deptcode }}</li>
          <li class="active">Edit</li>
      </ol>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
        {{ Form::open(array('method'=>'put','class' => 'form-horizontal','route'=>array('office.update',$office->id),'id'=>'officeForm')) }}
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
        <div class="col-md-offset-3 col-md-6  " style="padding:10px;">
          <div class="form-group">
            <div class="col-md-12">
              {{ Form::label('code','Department Code') }}
              {{ Form::text('code',Input::old('code') ? Input::old('code') : $office->code,[
                'class'=>'form-control',
                'placeholder'=>'Department Code'
              ]) }}
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
              {{ Form::label('name','Organization Name') }}
              {{ Form::text('name',Input::old('name') ? Input::old('name') : $office->name,[
                'class'=>'form-control',
                'placeholder'=>'Department Name'
              ]) }}
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
              {{ Form::label('description','Description') }}
              {{ Form::text('description',Input::old('description') ? Input::old('description') : $office->description,[
                'class'=>'form-control',
                'placeholder'=>'Description'
              ]) }}
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
              {{ Form::label('head','Organization Head') }}
              {{ Form::text('head',Input::old('head') ? Input::old('head') : $office->head,[
                'class'=>'form-control',
                'placeholder'=>'Full Name'
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
                <button id="cancel" class="btn btn-md btn-default" type="button" onClick="window.location.href='{{ url("maintenance/office") }}'" >
                  <span class="hidden-xs">Cancel</span>
                </button>
              </div>
          </div>
      </div> <!-- centered  -->
      {{ Form::close() }}

    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection
