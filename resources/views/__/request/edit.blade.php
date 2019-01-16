@extends('backpack::layout')

@section('header')
  <section class="content-header">
    <h1>
      Request No. {{ $request->code }}
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('request') }}">Request</a></li>
      <li>{{ $request->code }}</li>
      <li class="active">Edit</li>
    </ol>
  </section>
@endsection

@section('content')
@include('modal.request.supply')
<!-- Default box -->
  <div class="box">
    <div class="box-body">
      <form method="post" action="{{ route('request.update', $request->id) }}" class="form-horizontal" id="requestForm">
        
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        @include('request.form')

      </form>
    </div><!-- /.box-body -->
  </div><!-- /.box -->
@endsection