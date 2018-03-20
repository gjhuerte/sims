{{-- 
<style>
	.panel:hover {
		-webkit-box-shadow: -1px 6px 52px -9px rgba(87,81,87,1);
		-moz-box-shadow: -1px 6px 52px -9px rgba(87,81,87,1);
		box-shadow: -1px 6px 52px -9px rgba(87,81,87,1);
	}
</style> --}}
<!-- Default box -->
  <div class="box">
    <div class="box-body" style="padding: 20px;">
    	<div class="col-sm-12">

			@if(Auth::user()->access == 1 || Auth::user()->access == 6  || Auth::user()->access == 7  || Auth::user()->access == 8)
	    	<!-- add button -->
	    	<div class="col-sm-12" style="margin-bottom: 30px;">
	 			<a href="{{ url('announcement/create') }}" id="new" class="btn btn-success btn-md pull-right">
	 				<span class="fa fa-bullhorn"></span>  Create an Annoucement
	 			</a>
	    	</div>
	    	<!-- add button -->
			@endif

	    	<!-- fix button -->
	    	<div class="clearfix"></div>
	    	<!-- fix button -->

	     	<!-- notification list -->
			@foreach($announcements as $announcement)
		    <div class="panel panel-default" style="margin: 10px; border-radius: 0px; "> 

		    	<!-- notification header -->
		    	<div class="panel-heading" style="background-color: white;">

			    	<!-- fix button -->
			    	<div class="clearfix"></div>
			    	<!-- fix button -->

		    		<!-- buttons -->
	        		<div class="pull-right">
						@if(Auth::user()->access == 1 || Auth::user()->access == 6  || Auth::user()->access == 7  || Auth::user()->access == 8)

						<span class="label label-info label-md">Announcement for {{ $announcement->access_name }}</span>

						@endif

						 <span class="label label-primary">{{ Carbon\Carbon::parse($announcement->created_at)->diffForHumans() }}</span>
	        		</div>
		    		<!-- buttons -->

					<h3>
						{{  isset($announcement->title) ? ucfirst($announcement->title) : "None" }}
		    			@if(Auth::user()->access == 1 || Auth::user()->access == 6  || Auth::user()->access == 7  || Auth::user()->access == 8 && $announcement->user_id == Auth::user()->id)
	        			<div class="btn-group">
	        				<a href="{{ url("announcement/$announcement->id/edit") }}" class="btn btn-sm btn-default">
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

	    			<!-- left -->
{{-- 		        	<div class="col-sm-1 center-block">
						<a href="#"> 
							<img data-name="{{ isset($announcement->created_by) ? $announcement->created_by : "None" }}" class="media-object profile-image img-circle" alt="Profile Image" style="width: 64px;height: 64px;">
						</a> 
		        	</div> --}}
	    			<!-- left -->

	    			<!-- right -->
		        	<div class="col-sm-12">
 
						<h4 class="text-muted">By: <strong>{{  isset($announcement->created_by) ? $announcement->created_by : "None" }}</strong></h4> 
						<p style="font-size: @if(strlen($announcement->details) > 80) 16px @elseif(strlen($announcement->details) > 60) 17px @elseif(strlen($announcement->details) > 40) 18px @elseif(strlen($announcement->details) > 20) 19px @else 22px @endif;"><strong> Details: </strong>
							{{ strlen($announcement->details) > 0 ? $announcement->details : "No details specified"  }}
						</p> 

		        	</div>
	    			<!-- right -->

		        </div> 
	    		<!-- notification body -->

	    		@if(isset($announcement->url) && !is_null($announcement->url))
	    		<!-- notification footer -->
	    		<div class="panel-footer">
	    			You can view the link to the announcement by clicking <strong><a target="_blank" href="{{ $announcement->url }}">Me</a></strong>
	    		</div>
	    		<!-- notification footer -->
	    		@endif
	     	</div> 

	     	<hr />

	     	@endforeach 
	     	<!-- notification list -->

	     	<!-- pagination -->
	     	@if ($announcements->lastPage() > 1)

			    <!-- pagination class -->
			    <ul class="pagination pull-right" style="margin: 10px;">

			    	<!-- first page -->
			        <li class="{{ ($announcements->currentPage() == 1) ? ' disabled' : '' }}">
			            <a href="{{ $announcements->url(1) }}">First</a>
			         </li>
			    	<!-- first page -->

			    	<!-- pages list -->
			        @for ($i = 1; $i <= $announcements->lastPage(); $i++)

			            @php
				            $half_total_links = floor($link_limit / 2);
				            $from = $announcements->currentPage() - $half_total_links;
				            $to = $announcements->currentPage() + $half_total_links;
			            @endphp

			            @if ($announcements->currentPage() < $half_total_links) 
			            	@php
			               		$to += $half_total_links - $announcements->currentPage();
			            	@endphp
			            @endif 

			            @if ($announcements->lastPage() - $announcements->currentPage() < $half_total_links)
			            	@php
			                	$from -= $half_total_links - ($announcements->lastPage() - $announcements->currentPage()) - 1;
		                	@endphp
			            @endif

			            @if ($from < $i && $i < $to)
			                <li class="{{ ($announcements->currentPage() == $i) ? ' active' : '' }}">
			                    <a href="{{ $announcements->url($i) }}">{{ $i }}</a>
			                </li>
			            @endif
			        @endfor
			    	<!-- pages list -->

			    	<!-- last page -->
			        <li class="{{ ($announcements->currentPage() == $announcements->lastPage()) ? ' disabled' : '' }}">
			            <a href="{{ $announcements->url($announcements->lastPage()) }}">Last</a>
			        </li>
			    	<!-- last page -->
			    </ul>
			    <!-- pagination class -->

			@endif
	     	<!-- pagination -->

	    </div>
    </div><!-- /.box-body -->
  </div><!-- /.box -->