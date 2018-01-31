@extends('backpack::layout')

@section('header')
	<section class="content-header">
	  <h1>
	    RSMI
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="{{ url('rsmi') }}">RSMI</a></li>
	    <li class="active">Approval</li>
	  </ol>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
      <form method="post" action="{{ route('rsmi.receive', $rsmi->id) }}" class="form-horizontal" id="rsmiForm">
        
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        @include('rsmi.action-form')

      </form>
    </div><!-- /.box-body -->
  </div><!-- /.box -->
@endsection