@extends('layouts.master-blue')
@section('title')
Profile
@stop
@section('navbar')
@include('layouts.navbar')
@stop
@section('style')
<style>
	#page-body{
		display: none;
	}
</style>
@stop
@section('content')
<div class="container-fluid" id="page-body">
	<div class="col-sm-offset-3 col-sm-6">
		<div class="panel panel-default">
			<div class="panel-heading center" style="background: url('{{ asset('logo/images/circuits_gray.png') }}')background-color: white;">
			<img class="img img-circle" src="{{ asset('images/logo/LabHead/labhead-icon-32.png') }}" />
			</div>
			<div class="panel-body">
			</div>
		</div>
	</div>
</div>
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
		$('#page-body').show();
	});
</script>
@stop
