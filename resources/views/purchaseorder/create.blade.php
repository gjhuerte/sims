@extends('backpack::layout')

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">Purchase Order</h3></legend>
		<ul class="breadcrumb">
			<li><a href="{{ url('purchaseorder') }}">Purchase Order</a></li>
			<li class="active">Create</li>
		</ul>
	</section>
@endsection

@section('content')
@include('modal.request.supply')
<!-- Default box -->
  <div class="box" style="padding:10px;">
    <div class="box-body">
		{{ Form::open(['method'=>'post','route'=>array('purchaseorder.store'),'class'=>'form-horizontal','id'=>'purchaseOrderForm']) }}
        @include('errors.alert')
        @include('purchaseorder.form')
		{{ Form::close() }}
    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection
