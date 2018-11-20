@extends('backpack::layout')

@section('header')
  <section class="content-header">
    <legend><h3 class="text-muted">Customer Feedback</h3></legend>
  </section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
    <div class="panel panel-body table-responsive">
      <table class="table table-striped table-hover table-bordered" id='feedbackTable'>
        <thead>
          <th class="col-sm-1">Name</th>
          <th class="col-sm-1">Comment</th>
          <th class="no-sort col-sm-1"></th>
        </thead>
      </table>
    </div>

    </div><!-- /.box-body -->
  </div><!-- /.box -->

@endsection

@section('after_scripts')

<script>
  $(document).ready(function(){

      var table = $('#feedbackTable').DataTable( {
        serverSide: true,
        columnDefs:[
        { "width": "15%", "targets": 0 },
        { "width": "85%", "targets": 1 },
        { targets: 'no-sort', orderable: false }
        ],
        language: {
            searchPlaceholder: "Search..."
        },
        "dom": "<'row'<'col-sm-6'l><'col-sm-6'<'toolbar'>><'col-sm-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
      "processing": true,
          ajax: "{{ url('clientfeedback') }}",
          columns: [
              { data: "user" },
              { data: "comment" },
              { data: function(callback){
                return `
                    <a href="{{ url("clientfeedback") }}` + '/' + callback.id + '/show' + `" class="btn btn-sm btn-default">view</a>
                `;
              } }
          ],
      } );
  })
</script>
@endsection
