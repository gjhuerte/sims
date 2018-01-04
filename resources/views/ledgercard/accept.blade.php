@extends('backpack::layout')

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">Accept</h3></legend>
		<ul class="breadcrumb">
			<li><a href="{{ url('inventory/supply') }}">Supply Inventory</a></li>
			<li class="active">Accept</li>
		</ul>
	</section>
@endsection

@section('content')
@include('modal.request.supply')
<!-- Default box -->
  <div class="box" style="padding:10px;">
    <div class="box-body">
		{{ Form::open(['method'=>'post','route'=>array('supply.ledgercard.accept'),'class'=>'form-horizontal','id'=>'ledgerCardForm']) }}
        @include('errors.alert')
        @include('inventory.supply.form')
		{{ Form::close() }}

    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection