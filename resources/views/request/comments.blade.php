@extends('backpack::layout')

@section('header')
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body"><p class="text-muted" style="font-size: 50px">Comments </p>
		<div class="panel panel-body table-responsive">
			@foreach()

			@endforeach()
		</div>

        {{ Form::open(array('class' => 'col-md-offset-3 col-md-6  form-horizontal','method'=>'post','url'=>"request/$request->id/comments",'id'=>'commentsForm')) }}
            
          <div class="form-group">
            <div class="col-md-12">
              {{ Form::label('details','Details') }}
              {{ Form::text('details','',[
                'class'=>'form-control',
                'placeholder'=>'Details'
              ]) }}
            </div>
          </div>
          <div class="pull-right">
            <div class="btn-group">
              <button id="submit" class="btn btn-md btn-primary" type="submit">
                <span class="xs">Submit</span>
              </button>
            </div>
              <div class="btn-group">
                <button id="cancel" class="btn btn-md btn-default" type="button">
                  <span class="xs">Cancel</span>
                </button>
              </div>
          </div>
      </div> <!-- centered  -->
      {{ Form::close() }}
@endsection

@section('after_scripts')
@endsection
