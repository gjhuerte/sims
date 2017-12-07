@extends('backpack::layout')

@section('after_styles')
<style>    


</style>
@endsection

@section('header')
  <section class="content-header">
    <legend><h3 class="text-muted">Comments</h3></legend>
      <ol class="breadcrumb">
          <li>
              <a href="{{ url("request") }}">Request</a>
          </li>
          <li>
              <a href="{{ url("request/$request->id") }}">{{ $request->code }}</a>
          </li>
          <li class="active">Comments</li>
      </ol>
  </section>
@endsection

@section('content')
<!-- Default box -->
<div class="box">
  <div class="box-body">
    @if(count($comments) > 0)
			@foreach($comments as $comment)

            <div class="media conversation">
                <div class="media-body">
                    <h5 class="media-heading">{{ (isset($comment->user)) ? $comment->user->lastname : "None" }} {{ (isset($comment->user)) ? $comment->user->firstname : "None" }}</h5>
                    <small>{{ $comment->details }}</small>
                    <small>{{ Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</small>
                </div>
            </div>


			@endforeach
    @endif
    {{ Form::open(array('class' => 'form-horizontal','method'=>'post','url'=>"request/$request->id/comments",'id'=>'commentsForm')) }}
        
      <div class="form-group">
        <div class="col-md-12">
          <!-- image-preview-filename input [CUT FROM HERE]-->
          <div class="input-group image-preview">
            {{ Form::text('details','',[
              'class'=>'form-control',
              'placeholder'=>'Details'
            ]) }}
              <span class="input-group-btn">
                  <!-- image-preview-input -->
                  <div class="">
                    <button id="submit" class="btn btn-md btn-primary" type="submit">
                      <span class="xs">Submit</span>
                    </button>
                    <button id="cancel" class="btn btn-md btn-default" type="button">
                      <span class="xs">Cancel</span>
                    </button>
                  </div>
              </span>
          </div><!-- /input-group image-preview [TO HERE]--> 
        </div>
      </div>
    {{ Form::close() }}
    </div> <!-- centered  -->
  </div>
@endsection

@section('after_scripts')
@endsection
