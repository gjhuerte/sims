@extends('layouts.master')

@section('styles-include')
{{-- <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic" rel="stylesheet"> --}}
<style type="text/css">
  body{
    background: #22313F;
    /*font-family: 'Nanum Gothic', sans-serif;*/
  }

</style>
@endsection

@section('content')
{{-- container --}}
<div class="container-fluid" id="page-body" style="margin-top: 30px;">
  {{-- row --}}
  <div class="row">
    {{-- grid layout --}}
    <div class="col-md-offset-3 col-md-6">
      <div class="panel panel-default">
        <div class="panel-body">
          <legend><h3 class="text-muted"> Solution </h3></legend>

          <h3>{{ $faq->title }}</h3>
          <blockquote>
            {{ $faq->description }}
          </blockquote>

          @include('errors.alert')

          <form method="post" action="{{ url("question/$faq->id/solution") }}">

            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

            <div class="col-sm-12">
              <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" id="title" class="form-control" placeholder="Enter title here..." />
              </div>
            </div>

            <div class="col-sm-12">
              <div class="form-group">
                <label for="title">Description</label>
                <textarea rows="8" name="description" id="description" value="{{ old('description') }}" class="form-control" placeholder="Enter simple description for your issue..." ></textarea>
              </div>
            </div>

            <div class="col-sm-12">
              <div class="form-group pull-right">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ url('faqs') }}" class="btn btn-default">Cancel</a>
              </div>
            </div>

          </form>

        </div>

        <div class="panel-footer">
          @Supplies Inventory Management System
        </div>
      </div>
    </div> 
    {{-- grid layout --}}
  </div>
  {{-- row --}}
</div>
{{-- container --}}
@stop