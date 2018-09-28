<div class="col-md-12">
	<div class="form-group">
		{{ Form::label('Stock Number') }}
		{{ Form::text('stocknumber',isset($supply->stocknumber) ? $supply->stocknumber : Input::old('stocknumber'),[
			'id' => 'stocknumber',
			'class' => 'form-control'
		]) }}
	</div>
</div>
<div class="col-md-12">
	<div class="form-group">
		{{ Form::label('Details') }}
		{{ Form::text('details',isset($supply->details) ? $supply->details : Input::old('details'),[
			'id' => 'details',
			'class' => 'form-control'
		]) }}
	</div>
</div>
<div class="col-md-12">
	<div class="form-group">
		{{ Form::label('Unit Of Measurement') }}
		{{ Form::select('unit', $unit, isset($supply->unit) ? $supply->unit->id : Input::old('unit'), [
			'id' => 'unit',
			'class' => 'form-control'
		]) }}
	</div>
</div> 
<div class="col-md-12">
	<div class="form-group">
		{{ Form::label('Reorder Point') }}
		{{ Form::number('reorderpoint',isset($supply->reorderpoint) ? $supply->reorderpoint : Input::old('reorderpoint'),[
			'id' => 'reorderpoint',
			'class' => 'form-control'
		]) }}
	</div>
</div>