@extends('layouts.master')
@section('title')
Inventory | Add
@stop
@section('navbar')
@include('layouts.navbar')
@stop
@section('style')
{{ HTML::style(asset('css/select.bootstrap.min.css')) }}
<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
<style>
	#page-body{
		display: none;
	}

	a > hover{
		text-decoration: none;
	}

	th , tbody{
		text-align: center;
	}
</style>
@stop
@section('content')
<div class="container-fluid" id="page-body">
	<div class="col-md-offset-3 col-md-6 panel">
		<div class="panel-body">
			{{ Form::open(['method'=>'post','route'=>array('inventory.supply.store'),'class'=>'form-horizontal']) }}
			<legend><h3 class="text-muted">Supply Inventory</h3></legend>
			<ul class="breadcrumb">
				<li><a href="{{ url('inventory/supply') }}">Supply Inventory</a></li>
				<li class="active">Add</li>
			</ul>
			<div class="col-md-12">
				<div class="form-group">
					{{ Form::label('Stock Number') }}
					{{ Form::text('stocknumber',Input::old('stocknumber'),[
						'class' => 'form-control'
					]) }}
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					{{ Form::label('Entity Name') }}
					{{ Form::text('entityname',"Polytechnic University Of the Philippines",[
						'class' => 'form-control',
						'readonly'
					]) }}
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					{{ Form::label('Supply Type') }}
					{{ Form::select('supplytype',['Loading all items'],Input::old('item'),[
						'id' => 'item',
						'class' => 'form-control'
					]) }}
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					{{ Form::label('Unit Of Measurement') }}
					{{ Form::text('unit',Input::old('unit'),[
						'class' => 'form-control'
					]) }}
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					{{ Form::label('Price') }}
					{{ Form::number('price',Input::old('price'),[
						'class' => 'form-control'
					]) }}
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					{{ Form::label('Reorder Point') }}
					{{ Form::number('reorderpoint',Input::old('reorderpoint'),[
						'class' => 'form-control'
					]) }}
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<button class="btn btn-lg btn-primary btn-block">ADD</button>
				</div>
			</div>
			{{ Form::close() }}
		</div>
	</div>
</div>
@stop
@section('script-include')
<script>
$('document').ready(function(){

	$.ajax({
		type:'get',
		url: "{{ url("maintenance/item/type") }}",
		dataType: 'json',
		success: function(response){
			option = "";

			for(ctr = 0; ctr < response.data.length; ctr++)
			{
				option += `<option value="`+ response.data[ctr].itemtype +`">`+ response.data[ctr].itemtype + `</option>`; 
			}

			$('#item').html("")
			$('#item').append(option)

		}
	});

	$('#page-body').show()
})
</script>
@stop
