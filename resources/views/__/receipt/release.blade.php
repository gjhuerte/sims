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
      <legend><h3 class="text-muted">Request No. {{ $request->id }}</h3></legend>
      <table class="table table-hover table-condensed table-bordered" id="supplyTable">
        <thead>
          <tr>
            <th class="col-sm-1">Stock Number</th>
            <th class="col-sm-1">Information</th>
            <th class="col-sm-1">Issued Quantity</th>
            <th class="col-sm-1">Released Quantity</th>
            <th class="col-sm-1">Days to Consume</th>
          </tr>
        </thead>
        <tbody>
          @foreach($supplyrequest as $supplyrequest)
          @if($supplyrequest->quantity_issued > 0)
          <tr>
            <td>{{ $supplyrequest->stocknumber }}<input type="hidden" name="stocknumber[]" value="{{ $supplyrequest->stocknumber }}"</td>
            <td>{{ $supplyrequest->supply->supplytype }}</td>
            <td>{{ $supplyrequest->quantity_issued }}</td>
            <td><input type="number" name="quantity[{{ $supplyrequest->stocknumber }}]" class="form-control" value="{{ $supplyrequest->quantity_issued }}"  /></td>
            <td><input type="text" name="daystoconsume[{{ $supplyrequest->stocknumber }}]" class="form-control" /></td>
          </tr>
          @endif
          @endforeach
        </tbody>
      </table>
      <div class="pull-right">
        <div class="btn-group">
          <button type="button" id="approve" class="btn btn-md btn-danger btn-block">Release</button>
        </div>
        <div class="btn-group">
          <button type="button" id="cancel" class="btn btn-md btn-default">Cancel</button>
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

    $('#cancel').on('click',function(){
      window.location.href = "{{ url('request') }}"
    })

  });
</script>
@endsection
