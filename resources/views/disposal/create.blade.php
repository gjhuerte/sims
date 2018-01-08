@extends('backpack::layout')

@section('header')
	<section class="content-header">
	  <h1>
	    Disposal Report
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="{{ url('disposal') }}">Disposal</a></li>
	    <li class="active">Create</li>
	  </ol>
	</section>
@endsection

@section('content')
@include('modal.request.supply')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
    {{ Form::open(['method'=>'post','route'=>array('disposal.store'),'class'=>'form-horizontal','id'=>'disposalForm']) }}
        @include('errors.alert')
        @include('disposal.form')
      {{ Form::close() }}
    </div><!-- /.box-body -->
  </div><!-- /.box -->
@endsection