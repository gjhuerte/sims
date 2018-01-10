@extends('layouts.report')
@section('title',"Stock Card Preview")
@section('content')
  @foreach($supplies as $supply)
    <div id="content" class="col-sm-12" style="{{ ($supplies->last() !== $supply) ? "page-break-after:always;" : "" }}">
          @include('stockcard.print_content')
    </div>
  @endforeach
@include('layouts.print.stockcard-footer')
@endsection
