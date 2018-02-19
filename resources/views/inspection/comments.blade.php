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
<div class="box" style="padding:20px;"> 
  <div class="box-body"> 

    {{ Form::open(array('class' => 'form-horizontal','method'=>'post','url'=>"request/$request->id/comments",'id'=>'commentsForm')) }} 
      <legend>Message Box</legend>

      @include('errors.alert')
      <p class="text-muted">This module is for creating comments, suggestions, and other messages regarding the Request. Note: Your conversation is recorded.</p>
         
      <div class="form-group"> 
        <div class="col-md-12"> 
          <!-- message label -->
          {{ Form::label('Enter your message below:') }}
          <!-- message label -->

          <!-- message content -->
          {{ Form::textarea('details','',[ 
            'class'=>'form-control', 
            'placeholder'=>'Enter message here...' 
          ]) }} 
          <!-- message content -->
        </div>
      </div>

      <!-- buttons --> 
      <div class="btn-group pull-right"> 
          <!-- submit --> 
          <div class="btn-group"> 
            <button id="submit" class="btn btn-md btn-primary" type="submit"> 
              <span class="xs">Submit</span> 
            </button> 
          </div> <!-- submit -->
          <!-- cancel -->
          <div class="btn-group"> 
            <a href="{{ url("request/$request->id") }}" id="cancel" class="btn btn-md btn-default" type="button"> 
              <span class="xs">Cancel</span> 
            </a> 
          </div> <!-- cancel -->
      </div> <!-- buttons --> 

      <!-- prevent bug in displaying the buttons -->
      <div class="clearfix"></div>
      <!-- prevent bug in displaying the buttons -->

    {{ Form::close() }} 
    <hr />
    @if(count($comments) > 0) 
      @foreach($comments as $comment) 
 
      <p class="text-right" style="font-size: 12px;"><em>{{ Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</em></p>
      <div class="row"> 
        <div class="col-sm-1"> 
          <a href="#"> 
            <img data-name="{{ (isset($comment->user)) ? $comment->user->lastname : "None" }} {{ (isset($comment->user)) ? $comment->user->firstname : "None" }}" class="profile-image img img-circle" alt="Profile Image" style="height: 64px; width: 64px;"> 
          </a> 
        </div> 
        <div class="col-sm-10"> 
          
          <h4>
            <strong>{{ (isset($comment->user)) ? $comment->user->firstname : "Not Applicable" }} {{ (isset($comment->user)) ? $comment->user->lastname : "Not Applicable" }} :</strong>
          </h4> 
          <p>{{ $comment->details }}</p> 
        </div> 
      </div> 

      <hr />
      @endforeach 
    @endif 
    </div> <!-- centered  --> 
  </div> 
@endsection 
