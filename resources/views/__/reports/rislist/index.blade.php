@extends('backpack::layout')

@section('header')
	<section class="content-header">
	  <h1>
	    Request List
	  </h1>
	  <ol class="breadcrumb">
	    <li>Request List</li>
	    <li class="active">Home</li>
	  </ol>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box" style="padding:10px">
    <div class="box-body">
      <table class="table table-hover table-striped" id="requestlistTable" width=100%>
        <thead>
          <tr>
          <th>Month</th>
          <th>Total Requests</th>
          <th>Pending Requests</th>
          <th>Approved Requests</th>
          <th>Disapproved Requests</th>
          <th>Cancelled Requests</th>
          <th>Released Requests</th>
          <th></th>
          </tr>
        </thead>
        <tbody>
        @foreach($ris as $request)
        <tr>
          <td>{{ $request->month }}</td>
          <td>{{ $request->total_count }}</td>
          <td>{{ $request->pending_count }}</td>
          <td>{{ $request->approved_count }}</td>
          <td>{{ $request->disapproved_count }}</td>
          <td>{{ $request->cancelled_count }}</td>
          <td>{{ $request->released_count }}</td>
          <td><a href="{{ url('reports/rislist') }}/{{ $request->monthid }}" class="btn btn-default btn-sm"><i class="fa fa-list-ul" aria-hidden="true"></i> View</a></td>
        </tr>
        @endforeach
        </tbody>
      </table>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection

@section('after_scripts')
<script>
  jQuery(document).ready(function($) {

    table = $('#requestlistTable').DataTable({
      pageLength: 25,
      serverSide: true,
      stateSave: true,
      "processing": true,
      language: {
              searchPlaceholder: "Search..."
      },
      columnDefs:[
          { targets: 'no-sort', orderable: false },
      ],
      "order": [
        [0, 'asc']
      ],
      "dom": "<'row'<'col-sm-3'l><'col-sm-6'<'toolbar'>><'col-sm-3'f>>" +
                      "<'row'<'col-sm-12'tr>>" +
                      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    });
@endsection
