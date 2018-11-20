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
          <legend><h3 class="text-muted"> {{ ucfirst($faq->title) }}</h3></legend>

          <div class="breadcrumb">
            <li><a href="{{ url('/') }}"> Home</a></li>
            <li><a href="{{ url('faqs') }}"> Faqs</a></li>
            <li class="active">{{ $faq->title }}</li>
          </div>

          <blockquote>
            {{ $faq->description }}
          </blockquote>

          @if(Auth::check())
          <div class="form-group" style="margin-bottom: 2%;">
            <div class="col-sm-12">
              <a href="{{ url("question/$faq->id/solution/create") }}" class="btn btn-default pull-right">Submit your Solution</a>
            </div>
          </div>
          @endif
          
          <div class="clearfix" style="margin: 3%;"></div>

          <!-- notification list -->
          @foreach($solutions as $solution)
            <div class="panel panel-default" style="margin: 10px; border-radius: 0px; "> 

              <!-- notification header -->
              <div class="panel-heading" style="background-color: white;">

                <!-- fix button -->
                <div class="clearfix"></div>
                <!-- fix button -->

                <!-- buttons -->
                  <div class="pull-right">
                @if(Auth::user()->access == 1)

                <span class="label label-info label-md">Announcement for {{ $solution->access_name }}</span>

                @endif

                 <span class="label label-primary">{{ Carbon\Carbon::parse($solution->created_at)->diffForHumans() }}</span>
                  </div>
                <!-- buttons -->

                <h3>
                  {{  isset($solution->title) ? ucfirst($solution->title) : "None" }}
                    @if(Auth::user()->access == 1 && $solution->user_id == Auth::user()->id)
                      <div class="btn-group">
                        <a href="{{ url("announcement/$solution->id/edit") }}" class="btn btn-sm btn-default">
                          <span class="glyphicon glyphicon-pencil"></span> Edit
                        </a>
                      </div>
                      <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-danger">
                          <span class="glyphicon glyphicon-trash"></span>  Delete
                        </button>
                      </div>
                    @endif

                </h3> 
              </div>
              <!-- notification header -->

              <!-- notification body -->
              <div class="panel-body"> 
                <!-- right -->
                <div class="col-sm-12">
   
                  <h4 class="text-muted">By: <strong>{{  isset($solution->created_by) ? $solution->created_by : "None" }}</strong></h4> 
                  <p style="font-size: @if(strlen($solution->description) > 80) 16px @elseif(strlen($solution->description) > 60) 17px @elseif(strlen($solution->description) > 40) 18px @elseif(strlen($solution->description) > 20) 19px @else 22px @endif;">
                    {{ strlen($solution->description) > 0 ? $solution->description : "No details specified"  }}
                  </p> 

                </div>
                <!-- right -->

              </div> 
              <!-- notification body -->

              <!-- notification footer -->
              <div class="panel-footer">
                {{-- <div type="" class="btn btn-default"> ({{ $solution->upvote }}) <span class="glyphicon glyphicon-arrow-up"></span> Upvotes</div> --}}
                {{-- <div type="" class="btn btn-default"> ({{ $solution->upvote }}) <span class="glyphicon glyphicon-arrow-down"></span> Downvotes</div> --}}
                {{-- <div type="" class="btn btn-default"> ({{ $solution->upvote }}) <span class="glyphicon glyphicon-eye-open"></span> Reads</div> --}}
                {{-- <a href="{{ url("question/$solution->id/solution") }}" class="btn btn-default"> ({{ $solution->upvote }}) <span class="glyphicon glyphicon-list-alt"></span> Solution</a> --}}
              </div>
              <!-- notification footer -->

          </div> 

          @endforeach 
          <!-- notification list -->

          <!-- pagination -->
          @if ($solutions->lastPage() > 1)

              <!-- pagination class -->
              <ul class="pagination pull-right" style="margin: 10px;">

                <!-- first page -->
                  <li class="{{ ($solutions->currentPage() == 1) ? ' disabled' : '' }}">
                      <a href="{{ $solutions->url(1) }}">First</a>
                   </li>
                <!-- first page -->

                <!-- pages list -->
                  @for ($i = 1; $i <= $solutions->lastPage(); $i++)

                      @php
                        $half_total_links = floor($link_limit / 2);
                        $from = $solutions->currentPage() - $half_total_links;
                        $to = $solutions->currentPage() + $half_total_links;
                      @endphp

                      @if ($solutions->currentPage() < $half_total_links) 
                        @php
                            $to += $half_total_links - $solutions->currentPage();
                        @endphp
                      @endif 

                      @if ($solutions->lastPage() - $solutions->currentPage() < $half_total_links)
                        @php
                            $from -= $half_total_links - ($solutions->lastPage() - $solutions->currentPage()) - 1;
                          @endphp
                      @endif

                      @if ($from < $i && $i < $to)
                          <li class="{{ ($solutions->currentPage() == $i) ? ' active' : '' }}">
                              <a href="{{ $solutions->url($i) }}">{{ $i }}</a>
                          </li>
                      @endif
                  @endfor
                <!-- pages list -->

                <!-- last page -->
                  <li class="{{ ($solutions->currentPage() == $solutions->lastPage()) ? ' disabled' : '' }}">
                      <a href="{{ $solutions->url($solutions->lastPage()) }}">Last</a>
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