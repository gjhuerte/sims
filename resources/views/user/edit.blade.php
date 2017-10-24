@extends('layouts.master')
@section('title')
Settings
@stop
@section('navbar')
@include('layouts.navbar')
@stop
@section('script-include')
<script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
@stop
@section('style')
<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
@stop
@section('content')
<div class="container-fluid" id='page-body' hidden>
  <div class="col-md-offset-3 col-md-6">
    <div class="panel panel-body panel-shadow" style="margin-top: 70px;margin-bottom: 50px;padding: 20px;">
        @if (count($errors) > 0)
           <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <ul class="list-unstyled" style='margin-left: 10px;'>
                    @foreach ($errors->all() as $error)
                        <li class="text-capitalize">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
      <div class='col-sm-12'>
        <legend><h3 style="color:#337ab7;"> User Information </h3></legend>
      </div>
      {{ Form::open(['method'=>'POST','route'=>'settings.update','id'=>'registrationForm']) }}
      <div class="col-sm-12">
       <div class="form-group">
        {{ Form::label('firstname','First Name') }}
        {{ Form::text('firstname',$user->firstname,[
            'class' => 'form-control',
            'id' => 'firstname',
            'placeholder' => 'Firstname'
          ]) }}
        </div>
      </div>
      <div class="col-sm-12">
       <div class="form-group">
        {{ Form::label('middlename','Middle Name') }}
        {{ Form::text('middlename',$user->middlename,[
            'class' => 'form-control',
            'id' => 'middlename',
            'placeholder' => 'Middlename'
          ]) }}
        </div>
      </div>
      <div class="col-sm-12">
       <div class="form-group">
        {{ Form::label('lastname','Last Name') }}
        {{ Form::text('lastname',$user->lastname,[
            'class' => 'form-control',
            'id' => 'lastname',
            'placeholder' => 'Lastname'
          ]) }}
        </div>
      </div>
      <div class="col-sm-12">
       <div class="form-group">
        {{ Form::label('email','Email Address') }}
        {{ Form::email('email',$user->email,[
            'class' => 'form-control',
            'id' => 'email',
            'placeholder' => 'Email'
          ]) }}
        </div>
      </div>
      <div class='col-sm-12'>
        <legend><h3 style="color:#337ab7;"> Change Password </h3></legend>
      </div>
      <div class="col-sm-12">
       <div class="form-group">
        {{ Form::label('password','Current Password') }}
        {{ Form::password('password',[
            'class' => 'form-control',
            'id' => 'password',
            'placeholder' => 'Current Password'
          ]) }}
        </div>
      </div>
      <div class="col-sm-12">
       <div class="form-group">
        {{ Form::label('newpassword','New Password') }}
        {{ Form::password('newpassword',[
            'id' => 'newpassword',
            'class' => 'form-control',
            'placeholder' => 'New Password'
          ]) }}
        </div>
      </div>
      <div class="col-sm-12">
       <div class="form-group">
        {{ Form::label('confirm','Confirm Password') }}
        {{ Form::password('confirm',[
            'id' => 'confirm',
            'class' => 'form-control',
            'placeholder' => 'confirm'
          ]) }}
        </div>
      </div>
      <div class="col-sm-12">
        <div class="form-group">
        {{  Form::button('Update',[
          'id' => 'update',
          'class' => 'btn btn-md btn-primary btn-block'
        ]) }}
        </div>
      </div>
    {{ Form::close() }}
  </div><!-- Row -->
</div><!-- Container -->
@stop
@section('script')
<script type="text/javascript">
  $(document).ready(function(){
    @if( Session::has("success-message") )
      swal("Success!","{{ Session::pull('success-message') }}","success");
    @endif
    @if( Session::has("error-message") )
      swal("Oops...","{{ Session::pull('error-message') }}","error");
    @endif

    $('#update').on('click',function(){

      $("#registrationForm").submit();
    })

    $('#page-body').show();
  });
</script>
@stop
