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
	  <h1>
	    Release Form
	  </h1>
	  <ol class="breadcrumb">
	    <li>Request</li>
	    <li class="active">Release</li>
	  </ol>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
    {{ Form::open(['method'=>'delete','route'=>array('request.destroy',$request->id),'class'=>'form-horizontal','id'=>'requestForm']) }}
     
      @include('errors.alert')

      <legend><h3 class="text-muted">Requisition and Issue Slip {{ $request->code }}</h3></legend>

      <div class="col-sm-12">
          Rows in <span class="text-warning">Yellow</span> have issued quantity <em>greater than</em> requested quantity <br />
          Rows in <span class="text-danger">Red</span> have no more items to release
      </div>

      <br />

      <table class="col-sm-12 table table-hover table-condensed table-bordered" id="supplyTable">
        <thead>
          <tr>
            <th class="col-sm-1">Stock Number</th>
            <th class="col-sm-1">Information</th>
            <th class="col-sm-1">Remaining Quantity</th>
            <th class="col-sm-1">Issued Quantity</th>
            <th class="col-sm-1">Released Quantity</th>
            <th class="col-sm-1">Days to Consume</th>
          </tr>
        </thead>
        <tbody>
        @foreach($request->supplies as $supply)

          @if($supply->stock_balance <= 0)

          <tr class="danger">
            <td colspan="7" class="text-center text-danger">Supply with stocknumber of {{ $supply->stocknumber }} is not available for release and has {{ $supply->stock_balance }} balance.</td>
          </tr>

          @elseif($supply->pivot->quantity_issued > 0)

          <tr @if($supply->pivot->quantity_issued > $supply->stock_balance) class="warning" @endif>
            <td>{{ $supply->stocknumber }}<input type="hidden" name="stocknumber[]" value="{{ $supply->stocknumber }}"</td>
            <td>{{ $supply->details }}</td>
            <td>{{ $supply->stock_balance }}</td>
            <td>{{ $supply->pivot->quantity_issued }}</td>
            <td><input type="number" name="quantity[{{ $supply->stocknumber }}]" class="form-control" value="{{ $supply->pivot->quantity_issued }}"  /></td>
            <td><input type="text" name="daystoconsume[{{ $supply->stocknumber }}]" value="{{ App\StockCard::computeDaysToConsume($supply->stocknumber) }}" class="form-control" /></td>
          </tr>

          @endif

        @endforeach

        </tbody>
      </table>
      <div class="form-group">
          <div class="col-md-12 ">
            {{ Form::label('remarks','Received By( Fullname)') }}<br>
            {{ Form::text('remarks', '',[
              'class'=>'form-control',
              'id' => 'purpose',
              'placeholder'=>'Fullname' ])
            }}
          </div>
        </div>
      <div class="pull-right">
        <div class="btn-group">
          <button type="button" id="approve" class="btn btn-md btn-danger btn-block">Release</button>
        </div>
        <div class="btn-group">
          <button type="button" id="cancel" class="btn btn-md btn-default" onclick='window.location.href = "{{ url('request') }}"'>Cancel</button>
        </div>
      </div>
      {{ Form::close() }}
    </div><!-- /.box-body -->
  </div><!-- /.box -->
@endsection

@section('after_scripts')

<script>
  jQuery(document).ready(function($) {

    $('#approve').on('click',function(){
      console.log($('#supplyTable > tbody > tr').length)
      if($('#supplyTable > tbody > tr').length == 0)
      {
        swal('Blank Field Notice!','Supply table must have atleast 1 item','error')
      } else {
            swal({
              title: "Are you sure?",
              text: "This will no longer be editable once submitted. Do you want to continue?",
              type: "warning",
              showCancelButton: true,
              confirmButtonText: "Yes, submit it!",
              cancelButtonText: "No, cancel it!",
              closeOnConfirm: false,
              closeOnCancel: false
            },
            function(isConfirm){
              if (isConfirm) {
                $('#requestForm').submit();
              } else {
                swal("Cancelled", "Operation Cancelled", "error");
              }
            })
      }
    })
  });
</script>
@endsection
