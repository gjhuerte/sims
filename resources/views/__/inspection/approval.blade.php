@extends('backpack::layout')

@section('header')
	<section class="content-header">
	  <h1>
	    Inspection {{ $inspection->code }}
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="{{ url('inspection') }}">Inspection : {{ $inspection->code }}</a></li>
	    <li class="active">Stage 1</li>
	  </ol>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
      <form method="post" action="{{ url("inspection/$inspection->id/approve") }}" class="form-horizontal" id="inspectionForm">
        
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        @include('inspection.action-form')

      </form>
    </div><!-- /.box-body -->
  </div><!-- /.box -->
@endsection