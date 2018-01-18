@extends('backpack::layout')

@section('after_styles')
<style>
	a {
		color: #0254EB
	}
	a:visited {
		color: #0254EB
	}
	a.morelink {
		text-decoration:none;
		outline: none;
	}

	.morecontent span {
		display: none;
	}
</style>
@endsection

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">Audit Trail</h3></legend>
	  <ol class="breadcrumb">
	    <li><a href="{{ url('audittrail') }}">Audit Trail</a></li>
	  </ol>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
		<div class="panel panel-body table-responsive">
			<table class="table table-hover table-striped" id="auditTrailTable" width=100%>
				<thead>
					<th class="col-sm-1">Date</th>
					<th class="col-sm-1">Table Affected</th>
					<th class="col-sm-1">Action</th>
					<th class="col-sm-1">User</th>
					<th class="col-sm-1">Log</th>
				</thead>
			</table>
		</div>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection

@section('after_scripts')

<script>
	$(document).ready(function() {

	    var table = $('#auditTrailTable').DataTable({
	    	serverSide: true,
	    	processing: true,
			select: {
				style: 'single'
			},
			language: {
					searchPlaceholder: "Search..."
			},
			"processing": true,
			ajax: "{{ url('audittrail') }}",
			columns: [
				{ data: "parsed_date"},
				{ data: "auditable_type" },
				{ data: "event" },
				{ data: "user_fullname" },
				{ data: "new_values" }
			],
	    });
	} );

	$( document ).ajaxComplete(function( event, request, settings ) {
		var showChar = 50;
		var ellipsestext = "...";
		var moretext = "more";
		var lesstext = "less";
		$('.more').each(function() {
			var content = $(this).html();

			if(content.length > showChar) {

				var c = content.substr(0, showChar);
				var h = content.substr(showChar-1, content.length - showChar);

				var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

				$(this).html(html);
			}

		});

		$(".morelink").click(function(){
			if($(this).hasClass("less")) {
				$(this).removeClass("less");
				$(this).html(moretext);
			} else {
				$(this).addClass("less");
				$(this).html(lesstext);
			}
			$(this).parent().prev().toggle();
			$(this).prev().toggle();
			return false;
		});
	});
</script>
@endsection
