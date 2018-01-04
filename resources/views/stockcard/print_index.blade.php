@extends('layouts.report')
@section('title',"Stock Card $supply->stocknumber")
@section('content')
<div id="content" class="col-sm-12">
@include('stockcard.print_content')
</div>
@include('vendor.print_footer')
@endsection
