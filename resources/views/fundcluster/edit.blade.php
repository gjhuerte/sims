@extends('backpack::layout')

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">Fund Cluster</h3></legend>
		<ul class="breadcrumb">
			<li><a href="{{ url('purchaseorder') }}">Fund Cluster</a></li>
			<li class="active">Create</li>
		</ul>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box" style="padding:10px;">
    <div class="box-body">
		{{ Form::open(['method'=>'put','route'=>array('fundcluster.update', $fundcluster->id),'class'=>'form-horizontal','id'=>'fundClusterForm']) }}
        @if (count($errors) > 0)
            <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <ul style='margin-left: 10px;'>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    	@include('fundcluster.form')
		<div class="pull-right">
			<div class="btn-group">
				<button id="submit" class="btn btn-md btn-primary" type="submit">
					<span class="hidden-xs">Update</span>
				</button>
			</div>
			<div class="btn-group">
				<button id="cancel" class="btn btn-md btn-default" type="button" onClick="window.location.href='{{ url("fundcluster") }}'" >
				  <span class="hidden-xs">Cancel</span>
				</button>
			</div>
		</div>
		{{ Form::close() }}
    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection

@section('after_scripts')
@endsection
