@extends('backpack::layout')

@section('header')
	<section class="content-header">
	  <h1>
	    Request No. {{ $code }}
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="{{ url('request') }}">Request</a></li>
	    <li class="active">Create</li>
	  </ol>
	</section>
@endsection

@section('content')
@include('modal.request.supply')

<!-- Default box -->
  <div class="box">
    <div class="box-body" style="padding: 15px;">
      <form method="post" action="{{ route('request.store') }}" class="form-horizontal" id="requestForm">
        
        {{ csrf_field() }}

        @include('request.form')

      </form>

    </div><!-- /.box-body -->
  </div><!-- /.box -->
@endsection