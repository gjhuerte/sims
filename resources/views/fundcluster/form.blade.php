<div class="col-md-12">
	<div class="form-group">
		{{ Form::label('Code') }}
		{{ Form::text('code',isset($fundcluster->code) ? $fundcluster->code : old('code'),[
			'id' => 'code',
			'class' => 'form-control',
			'style' => 'background-color: white;'
		]) }}
	</div>
</div>
<div class="col-md-12">
	<div class="form-group">
		{{ Form::label('Description') }}
		{{ Form::text('description',isset($fundcluster->description) ? $fundcluster->description : old('description'),[
			'class' => 'form-control'
		]) }}
	</div>
</div>