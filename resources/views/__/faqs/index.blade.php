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
          <legend><h3 class="text-muted"> Frequently Asked Questions (Faqs)</h3></legend>

          <div class="breadcrumb">
            <li><a href="{{ url('/') }}"> Home</a></li>
            <li class="active">Faqs</li>
          </div>

          @if(Auth::check())
          <div class="form-group" style="margin-bottom: 2%;">
            <div class="col-sm-12">
              <a href="{{ url('question/create') }}" class="btn btn-default pull-right">Submit a Question</a>
            </div>
          </div>
          @endif

          <div class="col-md-12" style="margin-top: 2%">
              <form method="get" action="{{ url('faqs') }}" class="input-group">
                  <input type="text" class="search-query form-control" name="search" placeholder="Search" />
                  <span class="input-group-btn">
                      <button class="btn btn-info" type="submit">
                          <span class=" glyphicon glyphicon-search"> Search</span>
                      </button>
                  </span>
              </form>
          </div>

          <div class="clearfix" style="margin: 3%;"></div>

          <!-- notification list -->
          @foreach($faqs as $faq)
            <div class="panel panel-default" style="margin: 10px; border-radius: 0px; "> 

              <!-- notification header -->
              <div class="panel-heading" style="background-color: white;">

                <!-- fix button -->
                <div class="clearfix"></div>
                <!-- fix button -->

                <!-- buttons -->
                <div class="pull-right">

                  <span class="label label-primary">{{ Carbon\Carbon::parse($faq->created_at)->diffForHumans() }}</span>
                </div>
                <!-- buttons -->

                <h3>
                  {{  isset($faq->title) ? ucfirst($faq->title) : "None" }}
                    <small class="text-muted">By: <strong>{{  isset($faq->created_by) ? $faq->created_by : "None" }}</strong></small> 
                </h3> 
              </div>
              <!-- notification header -->

              <!-- notification body -->
              <div class="panel-body"> 
                <!-- right -->
                <div class="col-sm-12">

                  <p style="font-size: @if(strlen($faq->description) > 80) 16px @elseif(strlen($faq->description) > 60) 17px @elseif(strlen($faq->description) > 40) 18px @elseif(strlen($faq->description) > 20) 19px @else 22px @endif;">
                    {{ strlen($faq->description) > 0 ? $faq->description : "No details specified"  }}
                  </p> 

                </div>
                <!-- right -->

              </div> 
              <!-- notification body -->

              <!-- notification footer -->
              <div class="panel-footer">{{-- 
                <div type="" class="btn btn-default"> ({{ $faq->upvote }}) <span class="glyphicon glyphicon-arrow-up"></span> Upvotes</div>
                <div type="" class="btn btn-default"> ({{ $faq->downvote }}) <span class="glyphicon glyphicon-arrow-down"></span> Downvotes</div> --}}
                <a href="{{ url("question/$faq->id/solution") }}" class="btn btn-default"> ({{ $faq->reads }}) <span class="glyphicon glyphicon-list-alt"></span> Viewed Times (@if(Auth::check()) Click to View @else Login to View @endif )</a>
              </div>
              <!-- notification footer -->

          </div> 

          @endforeach 
          <!-- notification list -->

          <!-- pagination -->
          @if ($faqs->lastPage() > 1)

              <!-- pagination class -->
              <ul class="pagination pull-right" style="margin: 10px;">

                <!-- first page -->
                  <li class="{{ ($faqs->currentPage() == 1) ? ' disabled' : '' }}">
                      <a href="{{ $faqs->url(1) }}">First</a>
                   </li>
                <!-- first page -->

                <!-- pages list -->
                  @for ($i = 1; $i <= $faqs->lastPage(); $i++)

                      @php
                        $half_total_links = floor($link_limit / 2);
                        $from = $faqs->currentPage() - $half_total_links;
                        $to = $faqs->currentPage() + $half_total_links;
                      @endphp

                      @if ($faqs->currentPage() < $half_total_links) 
                        @php
                            $to += $half_total_links - $faqs->currentPage();
                        @endphp
                      @endif 

                      @if ($faqs->lastPage() - $faqs->currentPage() < $half_total_links)
                        @php
                            $from -= $half_total_links - ($faqs->lastPage() - $faqs->currentPage()) - 1;
                          @endphp
                      @endif

                      @if ($from < $i && $i < $to)
                          <li class="{{ ($faqs->currentPage() == $i) ? ' active' : '' }}">
                              <a href="{{ $faqs->url($i) }}">{{ $i }}</a>
                          </li>
                      @endif
                  @endfor
                <!-- pages list -->

                <!-- last page -->
                  <li class="{{ ($faqs->currentPage() == $faqs->lastPage()) ? ' disabled' : '' }}">
                      <a href="{{ $faqs->url($faqs->lastPage()) }}">Last</a>
                  </li>
                <!-- last page -->
              </ul>
              <!-- pagination class -->

          @endif
          <!-- pagination -->

        </div>
      </div>
    </div> 
    {{-- grid layout --}}
  </div>
  {{-- row --}}
</div>
{{-- container --}}
@stop