@extends('backpack::layout')

@section('after_styles')
<style>
    th , tbody{
      text-align: center;
    }
</style>
@endsection

@section('header')
	<section class="content-header">
		<legend><h3 class="text-muted">Receipt {{ $receipt->number }} Details</h3></legend>
		<ul class="breadcrumb">
			<li><a href="{{ url('receipt') }}">Receipt</a></li>
			<li class="active"> {{ $receipt->code }} </li>
		</ul>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
		<div class="panel panel-body table-responsive">
			<table class="table table-hover table-striped table-bordered table-condensed" id="receiptTable" cellspacing="0" width="100%"	>
				<thead>
          <tr rowspan="2">
              <th class="text-left" colspan="2">Receipt:  <span style="font-weight:normal">{{ $receipt->number }}</span> </th>
              <th class="text-left" colspan="2">Supplier:  <span style="font-weight:normal">{{ $receipt->supplier_name }}</span> </th>
          </tr>
          <tr rowspan="2">
              <th class="text-left" colspan="2">Invoice:  <span style="font-weight:normal">{{ $receipt->invoice }}</span> </th>
              <th class="text-left" colspan="2">Date Delivered:  <span style="font-weight:normal">{{ Carbon\Carbon::parse($receipt->date_delivered)->toFormattedDateString() }}</span> </th>
          </tr>
          <tr>
						<th class="col-sm-1">Stock Number</th>
						<th class="col-sm-1">Delivered Quantity</th>
						<th class="col-sm-1">Remaining Quantity</th>
						<th class="col-sm-1">Cost</th>
					</tr>
				</thead>
			</table>
		</div>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection

@section('after_scripts')

<script>
	$(document).ready(function() {

    var table = $('#receiptTable').DataTable({
			language: {
					searchPlaceholder: "Search..."
			},
			"dom": "<'row'<'col-sm-3'l><'col-sm-6'<'toolbar'>><'col-sm-3'f>>" +
							"<'row'<'col-sm-12'tr>>" +
							"<'row'<'col-sm-5'i><'col-sm-7'p>>",
			"processing": true,
			ajax: "{{ url("receipt/$receipt->number") }}",
			columns: [
					{ data: "stocknumber" },
					{ data: "quantity" },
					{ data: "remaining_quantity" },
					{ data: "cost" }
			],
    });

    $('div.toolbar').html(`
         <a href="{{ url("receipt/$receipt->number/print") }}" target="_blank" id="print" class="print btn btn-sm btn-default ladda-button" data-style="zoom-in">
          <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
          <span id="nav-text"> Print</span>
        </a>
    `)

    $('#print').on('click', function(){
      html = ''
      progress = 0
      $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'get',
        url: '{{ url("receipt/$receipt->number/print") }}',
        dataType: 'html',
        success: function(callback){
          // Create a new instance of ladda for the specified button
          var l = Ladda.create( document.querySelector( '#print' ) );

          // Start loading
          l.start();
          $('<iframe>', {
            name: 'myiframe',
            class: 'printFrame'
          })

          .appendTo('body')
          .contents().find('body')

          .append(callback);

          setInterval(function(){

                l.setProgress( progress );
                progress = progress +  0.1
          },300)
          $('.printFrame').hide()
          setTimeout(function(){
            l.stop();
            $('.printFrame').show()
            window.frames['myiframe'].focus();
            window.frames['myiframe'].print();
            $('.printFrame').remove()
          },3000)
        }
      })
      // e.preventDefault()
    });

	} );
</script>
@endsection
