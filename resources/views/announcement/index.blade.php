@extends('backpack::layout')

@section('header')
	<section class="content-header">
		<legend>
			@if(Auth::user()->access == 1)
			<h3 class="text-muted">Announcements</h3>
			@else
			<h3 class="text-muted">Dashboard</h3>
			@endif
		</legend>
		<ol class="breadcrumb">
			@if(Auth::user()->access == 1)
			<li>Announcements</li>
			@else
			<li class="text-muted">Dashboard</li>
			@endif
			<li class="active">Home</li>
		</ol>
		</section>
@endsection

@section('content')

@include('announcement.display-announcement')

@endsection
