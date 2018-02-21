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

    <!-- box-body -->
    <div class="box-body" style="margin-top:20px;">

    	{{-- content --}}
		<div>

			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active">
					<a href="#inventory" aria-controls="inventory" role="tab" data-toggle="tab">Inventory</a>
				</li>
				<li role="presentation">
					<a href="#references" aria-controls="references" role="tab" data-toggle="tab">References</a>
				</li>
			</ul>
			<!-- Nav tabs -->

			<!-- Tab panes -->
			<div class="tab-content">

				{{-- inventory panel --}}
				<div role="tabpanel" class="tab-pane active" id="inventory" style="padding: 5px;">
					
					<div class="col-sm-12" style="margin-bottom: 10px; margin-top: 30px;">
						<div class="form-group">
							<input type="radio" name="card" id="stockcard" checked/> Stock Card
							<input type="radio" name="card" id="ledgercard" /> Ledger Card
						</div>
					</div>

					<div class="col-sm-12" style="margin-bottom: 10px;">
						<div class="form-group">
							<legend>Rows</legend>
							<div id='type' style="margin-bottom: 10px;">
				    			<input type="radio" name="rows" id="all-rows" /> All supply
				    			<input type="radio" name="rows" id="specific-rows" checked /> Specific supply
							</div>
							<input type="text" value="" class="form-control" name="stocknumber" id="specific-stocknumber" placeholder="Enter Specific Stock Number Here..." style="margin-bottom: 20px;" />
							<div class="pull-right">
				    			<button type="button" data-loading-text="Synchronizing..." id="update-references" autocomplete="off" class="btn btn-info">Sync References</button>
				    			<button type="button" data-loading-text="Updating..." id="update" autocomplete="off" class="btn btn-success">Update</button>
							</div> 
						</div>
					</div>

				</div>
				{{-- inventory panel --}}

				{{-- references --}}
				<div role="tabpanel" class="tab-pane" id="references">
					
				</div>
				{{-- references --}}

			</div>
			<!-- Tab panes -->

			<div class="col-sm-12" style="margin-bottom: 10px;margin-top: 20px;">
				<legend>Details</legend>
				<div class="progress">
				  <div class="progress-bar progress-bar-striped active" id="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
				    <span class="sr-only"><span id="complete-percentage">0</span>% Complete</span>
				  </div>
				</div>
				<textarea readonly class="form-control" id="logs" name="logs" rows="16" placeholder="View logs here..."></textarea>
			</div>

		</div>
    	{{-- content --}}

    </div>
    <!-- /.box-body -->

  </div>
  <!-- /.box -->

@endsection

@section('after_scripts')
<script>
	$(document).ready(function(){

		jQuery.fn.extend({
		  appendMessage: function(message){
				var object = $(this);
				object.focus().val( object.val() + "\r\n" + message);
			}
		});

		$('#all-rows').on('change', function(){
			if($('#all-rows').prop('checked')){
				$('#specific-stocknumber').prop('disabled', true)
			}
		})

		$('#specific-rows').on('change', function(){
			if($('#specific-rows').prop('checked')){
				$('#specific-stocknumber').prop('disabled', false)
			}
		})

		$('#update-references').on('click', function(){
			initProgressBar()
			$('#logs').val('Initializing....')
			$('#logs').appendMessage('Updating References Based on the Stock Number');
			$('#logs').appendMessage('Done.');
		})

		$('#update').on('click', function(){

			initProgressBar()
			$('#logs').val('Initializing....')

			stockcard = true;

			if($('#stockcard').prop('checked')){
				stockcard = false;
			}

			rows = 'all';
			
			if($('#specific-rows').prop('checked')){
				rows = 'specific';
			}

			_log = $('#logs')
			stocknumbers = $('#specific-stocknumber').val()

			$.ajax({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
				type: 'get',
				url: '{{ url('sync/getstocknumberlist') }}',
				dataType: 'json',
				data:{
					'stockcard': stockcard,
					'rows': rows,
					'stocknumbers': stocknumbers
				},
				beforeSend: function(response){
					_log.appendMessage('Waiting for response....')
					_log.appendMessage('Passing:' + stocknumbers)
				},
				success: function(response){
					_log.appendMessage('Stock Numbers fetched.....')

					ctr = 0;
					length = response.message.length;
					if(length > ctr)
					{
						stocks = response.message;
						_log.appendMessage('Remaining Items: ' + (length - ctr))
						percentage = computePercentage(length, ctr)
						ctr = updateBalanceOfStock(stockcard, rows, stocks[ctr], ctr, length, stocks)
					}

				},
				error: function(response){
					_log.appendMessage('An error has occurred....')
					_log.appendMessage(JSON.stringify(response))
				},
				complete: function(response){
					_log.appendMessage('Main Process Ended....')
				}
			})

	        var $btn = $(this);
	        $btn.button('loading');
	        // simulating a timeout
	        setTimeout(function () {
	            $btn.button('reset');
	        }, 1000);

		})

		function updateBalanceOfStock(stockcard, rows, stocknumber, ctr, length)
		{

			$.ajax({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
				type: 'post',
				url: '{{ url('sync') }}',
				dataType: 'json',
				data:{
					'stockcard': stockcard,
					'rows': rows,
					'stocknumber': stocknumber
				},
				beforeSend: function(response){
					_log.appendMessage('Now Processing:' + stocknumber)
				},
				success: function(response){
					_log.appendMessage('Response received....')
					_log.appendMessage('Balance Successfully Synchronized....')
				},
				error: function(response){
					_log.appendMessage('An error has occurred....')
					_log.appendMessage(JSON.stringify(response))
				},
				complete: function(response){
					ctr++;
					if(length > ctr)
					{
						stocknumber = stocks[ctr];
						_log.appendMessage('Remaining Items: ' + (length - ctr))
						percentage = computePercentage(length, ctr)
						ctr = updateBalanceOfStock(stockcard, rows, stocknumber, ctr, length)
					}

					_log.appendMessage('Process of ' + stocknumber + ' has ended....')
				}
			})

			return ctr;

		}

		function initProgressBar(width = 0)
		{
			$('#progress-bar').css('width', width +'%')
		}

		function computePercentage(total, remaining)
		{
			width = 0;
			remaining = remaining + 1;
			width = (remaining/total) * 100;
			$('#progress-bar').css('width', width +'%')
			$('#complete-percentage').text(width)

			if(width == 100)
			{
				swal('Synchronization Completed!', 'The balance has been sychronized completely', 'info')
			}

			return width;
		}
	})
</script>	
@endsection
