@extends('backpack::layout')

@section('after_styles')
<style>
	.image-preview-input {
	    position: relative;
		overflow: hidden;
		margin: 0px;    
	    color: #333;
	    background-color: #fff;
	    border-color: #ccc;    
	}
	.image-preview-input input[type=file] {
		position: absolute;
		top: 0;
		right: 0;
		margin: 0;
		padding: 0;
		font-size: 20px;
		cursor: pointer;
		opacity: 0;
		filter: alpha(opacity=0);
	}
	.image-preview-input-title {
	    margin-left:2px;
	}

	select {
	    -webkit-appearance: none;
	    -moz-appearance: none;
	    text-indent: 1px;
	    text-overflow: '';
	}
</style>
@endsection

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">Import</h3></legend>
	  <ol class="breadcrumb">
	    <li><a href="{{ url('audittrail') }}">Import</a></li>
	    <li class="active">Home</li>
	  </ol>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body" style="margin-top:20px;">
    	<div class="col-sm-12">
    		<div class="form-group">
    			<legend>Instructions</legend>
    			<ol>
	    			<li class="text-muted">Click Browse Button</li>
	    			<li class="text-muted">
	    				Browse for Excel File. Only the following are supported types: 
	    				<ul>
	    					<li>csv</li>
	    				</ul>
	    			</li>
	    			<li class="text-muted">Select the module to import to</li>
	    			<li class="text-muted">Press Import</li>
	    			<li class="text-muted">The system will process your excel file and return the converted file</li>
	    			<li class="text-muted">On the table below, select the ones you want to import</li>
	    		</ol>
    		</div>
    	</div>

	    {{ Form::open([ 'method' => 'post' , 'url' => array('import'), 'enctype'=> "multipart/form-data", 'id' => 'importForm' ]) }}
	    <div class="col-md-6">
	    	<div class="col-sm-12">
	    		<div class="form-group">
		            <!-- image-preview-filename input [CUT FROM HERE]-->
		            <div class="input-group image-preview">
		                <input type="text" value="{{ old('input-file-preview') ? old('input-file-preview') : "" }}" class="form-control image-preview-filename" readonly style="background-color:white;"> <!-- don't give a name === doesn't send on POST/GET -->
		                <span class="input-group-btn">
		                    <!-- image-preview-input -->
		                    <div class="btn btn-default image-preview-input">
		                        <span class="glyphicon glyphicon-folder-open"></span>
		                        <span class="image-preview-input-title">Browse</span>
		                        <input type="file" name="input-file-preview"/> <!-- rename it -->
		                    </div>
		                </span>
		            </div><!-- /input-group image-preview [TO HERE]--> 
	    		</div>
	    	</div>
    	</div>
		<div class="col-md-6">

	    	<div class="form-group">
	    		<div class="col-sm-12">
		    		<div class="input-group">
		    			<select class="form-control" value="{{ old('type') ? old('type') : "" }}" id="type" name="type">
		    			@if(count($options) > 0)
		    				@foreach($options as $key => $value)
		    				<option value="{{ $key }}">{{ $value }}</option>
		    				@endforeach
		    			@endif
		    			</select>
		    			<div class="input-group-btn">
		    				<button type="button" id="import" class="btn btn-md btn-primary">
		                        <span class="glyphicon glyphicon-check"></span>
		    					Import
		    				</button>
		    			</div>
		    		</div>
	    		</div>
	    	</div>
	    </div>
		@if(isset($records) && count($records) > 0)
	    <div class="col-md-12">
			<div class="panel panel-body table-responsive">
				<table class="table table-hover table-bordered table-striped" id="importTable" width=100%>
					<thead>
						@foreach($keys as $key)
						<th class="col-sm-1">{{ $key }}</th>
						@endforeach
					</thead>
					<tbody>
					@foreach($records as $record)
						<tr>
						@foreach($keys as $key)
							<td>{{ $record[$key] }}</td>
						@endforeach
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
			@endif
		</div>


	    {{ Form::close() }}

    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection

@section('after_scripts')
<script>
	$(document).ready(function(){

		$(function() {
		    // Create the preview image
		    $(".image-preview-input input:file").change(function (){     
		        var img = $('<img/>', {
		            id: 'dynamic',
		            width:250,
		            height:200
		        });      
		        var file = this.files[0];
		        var reader = new FileReader();
		        // Set preview image into the popover data-content
		        reader.onload = function (e) {
		            $(".image-preview-input-title").text("Change");
		            $(".image-preview-clear").show();
		            $(".image-preview-filename").val(file.name);            
		            img.attr('src', e.target.result);
		        }        
		        reader.readAsDataURL(file);
		    });  
		});

		$('#import').on('click',function(){
        	swal({
	          title: "Are you sure?",
	          text: "This will no longer be editable once submitted. Do you want to continue?",
	          type: "info",
	          showCancelButton: true,
	          confirmButtonText: "Yes, submit it!",
	          cancelButtonText: "No, cancel it!",
	          closeOnConfirm: false,
	          closeOnCancel: false
	        },
	        function(isConfirm){
	          if (isConfirm) {
	          	$('#importForm').submit();
	          } else {
	            swal("Cancelled", "Operation Cancelled", "error");
	          }
	        })

		})
	})
</script>	
@endsection
