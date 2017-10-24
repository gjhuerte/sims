@extends('layouts.master-plain')
@section('title')
Password Reset
@stop
@section('script-include')
<script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
@stop
@section('style')
<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
<style>
  #page-body, #page-two{
    display: none;
  }

  body > .container-fluid {
    margin-top: 70px;
  }

  .form-group {
    margin-top: 20px;
  }

  #reset {
    margin-top: 30px;
  }
</style>
@stop
@section('content')
<div class="container-fluid" id='page-body'>
  <div class="panel-shadow col-md-offset-4 col-md-4" style="padding:20px;">
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
    {{ Form::open(['method'=>'POST','route'=>'settings.update','id'=>'resetForm']) }}
    <legend><h3 class="text-muted">Forgot Password</h3></legend>
    <ul class="breadcrumb">
      <li><a href="{{ url('login') }}">Home</a>
      <li class="active">Reset</li>
    </ul>
    <div id="page-one">
      <div class="form-group">
          {{ Form::label('code','Reset Code') }}
          {{ Form::password('code',[
              'class' => 'form-control',
              'id' => 'code',
              'placeholder' => 'xxxx-xxxx-xxxx-xxxx'
            ]) }}
            <p class="text-muted" id="reminder" style="font-size: 10px;"><strong>Reminder: </strong>Please check your email for the code! <a href="#">Resend Code?</a></p>
      </div>
    </div>
    <div id="page-two">
      <div class="form-group">
        {{ Form::label('password','New Password') }}
        {{ Form::password('password',[
            'class' => 'form-control',
            'id' => 'password',
            'placeholder' => 'New Password'
          ]) }}
      </div>
      <div class="form-group">
        {{ Form::label('confirm','Confirm Password') }}
        {{ Form::password('confirm',[
            'class' => 'form-control',
            'id' => 'confirm',
            'placeholder' => 'Confirm Password'
        ]) }}
      </div>
      <div class="form-group">
          {{  Form::submit('Reset',[
            'id' =>'reset',
            'class' => 'btn btn-primary pull-right btn-flat',
            'style' => 'padding: 1px 10px;'
          ]) }}
      </div>
    </div>
    {{ Form::close() }}
    </div>
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

    $( "#resetForm" ).validate( {
      rules: {
        code: {
          required: true
        },
        password: {
          required: true,
          minlength: 8
        },
        confirm: {
          required: true,
          minlength: 8,
          equalTo: "#password"
        },
      },
      messages: {
        code: {
          required: "Please provide the code sent to your email"
        },
        password: {
          required: "Please provide a password",
          minlength: "Your password must be at least 8 characters long"
        },
        confirm: {
          required: "Please provide a password",
          minlength: "Your password must be at least 8 characters long",
          equalTo: "Please enter the same password as above"
        },
      },
      errorElement: "em",
      errorPlacement: function ( error, element ) {
        // Add the `help-block` class to the error element
        error.addClass( "help-block" );

        // Add `has-feedback` class to the parent div.form-group
        // in order to add icons to inputs
        element.parents( ".form-group" ).addClass( "has-feedback" );

        if ( element.prop( "type" ) === "checkbox" ) {
          error.insertAfter( element.parent( "label" ) );
        } else {
          error.insertAfter( element );
        }

        // Add the span element, if doesn't exists, and apply the icon classes to it.
        if ( !element.next( "span" )[ 0 ] ) {
          $( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
        }
      },
      success: function ( label, element ) {
        // Add the span element, if doesn't exists, and apply the icon classes to it.
        if ( !$( element ).next( "span" )[ 0 ] ) {
          $( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
        }
      },
      submitHandler: function(form) {
        // do other things for a valid form
      },
      highlight: function ( element, errorClass, validClass ) {
        $( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
        $( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
      },
      unhighlight: function ( element, errorClass, validClass ) {
        $( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
        $( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
      }
    } );
    
    $('#page-body').show();
  });
</script>
@stop
