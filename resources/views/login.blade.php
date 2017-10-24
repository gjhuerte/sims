@extends('layouts.master')
@section('title')
Login
@stop
@section('navbar')
{{-- @include('layouts.navbar.main.default') --}}
@stop
@section('style')
<link rel="stylesheet" href="{{ asset('css/style.css') }}"  />
<style>
  #return{
    text-decoration: none;
  }

  #return.hover{
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  }

  a{
    text-decoration: none;
    display: block;
  }

  #page-body{
    display: none;
  }

  body{
    background-color: #e5e5e5;
  }
</style>
@stop
@section('script-include')
<script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
@stop
@section('content')
<div class="container-fluid" id="page-body" style="margin-top: 100px;">
  <div class="row">
    <div class="col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4">
      <div class="col-sm-12">
        <div class="panel panel-body panel-shadow" style="padding: 40px;border: 1px solid #e5e5e5;" id="loginPanel">
          <div class="col-sm-12 center-block">
              <legend><h3 class="text-muted">Supply Inventory System</h3></legend>
          </div>
          <!-- <legend><h3 class="text-center text-primary">Log In</h3></legend> -->
          <div class="col-sm-12">
            <div id="error-container"></div>
            {{ Form::open(array('class' => 'form-horizontal','route'=>['login'],'id'=>'loginForm')) }}
            <div class="form-group">
              <div class="col-md-12">
                {{ Form::label('username','Username') }}
                {{ Form::text('username',Input::old('username'),[
                  'required',
                  'id'=>'username',
                  'class'=>'form-control',
                  'placeholder'=>'Username',
                ]) }}
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12">
              {{ Form::label('Password') }}
              {{ Form::password('password',[
                  'required',
                  'id'=>'password',
                  'class'=>'form-control',
                  'placeholder'=>'Password',
              ]) }}
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12">
                  <button type="submit" id="loginButton" data-loading-text="Logging in..." class="btn btn-lg btn-primary btn-block" autocomplete="off">
                  Login
                </button>
              </div>
            </div>
          {{ Form::close() }}
          </div>
        </div>
      </div>
    </div> <!-- centered  -->
  </div><!-- Row -->
</div><!-- Container -->
@stop
@section('script')
{{ HTML::script(asset('js/loadingoverlay.min.js')) }}
{{ HTML::script(asset('js/loadingoverlay_progress.min.js')) }}
<script>
  $(document).ready(function(){

    @if( Session::has("success-message") )
        swal("Success!","{{ Session::pull('success-message') }}","success");
    @endif

    @if( Session::has("error-message") )
        swal("Oops...","{{ Session::pull('error-message') }}","error");
    @endif

    $('#page-body').show();
  });
</script>
@stop
