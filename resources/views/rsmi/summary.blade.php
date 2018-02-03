@extends('backpack::layout')

@section('header')
	<section class="content-header">
	  <h1>
	    RSMI
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="{{ url('rsmi') }}">RSMI</a></li>
	    <li class="active">Recapitulation</li>
	  </ol>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
        @include('rsmi.summary-form')
    </div><!-- /.box-body -->
  </div><!-- /.box -->
@endsection