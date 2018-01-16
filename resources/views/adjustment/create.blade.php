@extends('backpack::layout')

@section('header')
	<section class="content-header">
	  <h1>
	    Adjustment Report
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="{{ url('adjustment') }}">Adjustment</a></li>
	    <li class="active">Return</li>
	  </ol>
	</section>
@endsection

@section('content')
@include('modal.request.supply')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
    {{ Form::open(['method'=>'post','route'=>array('adjustment.store'),'class'=>'form-horizontal','id'=>'adjustmentForm']) }}
        @include('errors.alert')
        @include('adjustment.form')
      {{ Form::close() }}
    </div><!-- /.box-body -->
  </div><!-- /.box -->
@endsection