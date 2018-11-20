@extends('backpack::layout')

@section('after_styles')
    <!-- Ladda Buttons (loading buttons) -->
    <link href="{{ asset('vendor/backpack/ladda/ladda-themeless.min.css') }}" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
		<style>

			a > hover{
				text-decoration: none;
			}

			th , tbody{
				text-align: center;
			}

			td{
				font-size: 12px;
			}
		</style>

    <!-- Bootstrap -->
    {{ HTML::style(asset('css/jquery-ui.css')) }}
    {{ HTML::style(asset('css/sweetalert.css')) }}
    {{ HTML::style(asset('css/dataTables.bootstrap.min.css')) }}
@endsection

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">Edit Account Information</h3></legend>
	  {{-- <ol class="breadcrumb">
	    <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/dashboard') }}">Das</a></li>
	    <li class="active">{{ trans('backpack::backup.backup') }}</li>
	  </ol> --}}
	</section>
@endsection

@section('content')
<!-- Default box -->
<div class="container-fluid" id='page-body' style="background-color:white;padding:20px;">
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
  <div class="col-md-6">
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
    </div>
  <div class="col-md-6">
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
        {{ Form::password('newpassword_confirmation',[
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
@endsection

@section('after_scripts')
    <!-- Ladda Buttons (loading buttons) -->
    <script src="{{ asset('vendor/backpack/ladda/spin.js') }}"></script>
    <script src="{{ asset('vendor/backpack/ladda/ladda.js') }}"></script>

    {{ HTML::script(asset('js/jquery-ui.js')) }}
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    {{ HTML::script(asset('js/sweetalert.min.js')) }}

<script>
	$(document).ready(function() {

		@if( Session::has("success-message") )
			swal("Success!","{{ Session::pull('success-message') }}","success");
		@endif
		@if( Session::has("error-message") )
			swal("Oops...","{{ Session::pull('error-message') }}","error");
		@endif

    $('#update').on('click',function(){
      $("#registrationForm").submit();
    })
	} );
</script>
@endsection
