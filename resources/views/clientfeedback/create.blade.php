@extends('backpack::layout')


@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
        {{ Form::open(array('class' => 'form-horizontal','method'=>'post','route'=>'clientfeedback.store','id'=>'clientfeedbackForm')) }}
        <div class="col-md-offset-3 col-md-6" style="padding:10px;">
          @include('errors.alert')
          <div class="form-group">
            <div class="col-md-12">
              {{ Form::label('comment','Comments and Suggestions') }}
              {{ Form::textarea('comment','',[
                'class'=>'form-control',
                'placeholder'=>'Details'
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
                <button id="cancel" class="btn btn-md btn-default" type="button" onClick="window.location.href='{{ url("request/") }}'" >
                  <span class="hidden-xs">Cancel</span>
                </button>
              </div>
          </div>
      </div> <!-- centered  -->
      {{ Form::close() }}

    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection
