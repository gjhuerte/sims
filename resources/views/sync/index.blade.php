@extends('backpack::layout')

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">Synchronize Data</h3></legend>
	  <ol class="breadcrumb">
	    <li><a href="{{ url('sync') }}">Sync</a></li>
	    <li class="active">Home</li>
	  </ol>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body" style="margin-top:20px;">
    	<div class="col-sm-12" style="margin-bottom: 10px;">
	    	<legend>Choose a module from below</legend>
	    	<button type="button" class="btn btn-primary">Stock Card</button>
	    	<button type="button" class="btn btn-success">Ledger Card</button>
    	</div>

    	<div class="col-sm-12" style="margin-bottom: 10px;">
	    	<legend>Action</legend>
    		<button type="button" class="btn btn-primary">Update Balance (All)</button>
    		<button type="button" class="btn btn-info">Update Balance (Specific Stock)</button>
    	</div>

    	<div class="col-sm-12" style="margin-bottom: 10px;">
	    	<legend>Logs</legend>
	    	<table class="table table-hover table-bordered table-condensed">
	    		<thead>
	    			<tr>
	    				<td>Date Time</td>
	    				<td>Details</td>
	    				<td>Status</td>
	    			</tr>
	    		</thead>
	    		<tbody>
	    			
	    		</tbody>
	    	</table>
    	</div>
    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection

@section('after_scripts')
<script>
	$(document).ready(function(){

	})
</script>	
@endsection
