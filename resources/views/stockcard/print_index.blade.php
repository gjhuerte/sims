@extends('layouts.report')
@section('title',"Stock Card $supply->stocknumber")
@section('content')
<div id="content" class="col-sm-12">
@include('stockcard.print_content')
    <tr>
      <td colspan=7 class="col-sm-12"><p class="text-center">  ******************* Nothing Follows ******************* </p></td>
    </tr>
</div>
@include('layouts.print.stockcard-footer')
@endsection
