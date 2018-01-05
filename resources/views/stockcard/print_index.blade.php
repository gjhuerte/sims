@extends('layouts.report')
@section('title',"Stock Card $supply->stocknumber")
@section('content')
<div id="content" class="col-sm-12">
@include('stockcard.print_content')
</div>
@include('layouts.print.stockcard-footer')
@endsection
