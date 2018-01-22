
<div class="form-group">
  <div class="col-md-12">
    {{ Form::label('abbreviation','Department Code') }}
    {{ Form::text('abbreviation', isset($department->abbreviation) ? $department->abbreviation : old('abbreviation'),[
      'class'=>'form-control',
      'placeholder'=>'Department Code'
    ]) }}
  </div>
</div>
<div class="form-group">
  <div class="col-md-12">
    {{ Form::label('name','Department Name') }}
    {{ Form::text('name', isset($department->name) ? $department->name : old('name'),[
      'class'=>'form-control',
      'placeholder'=>'Department Name'
    ]) }}
  </div>
</div>
