<div class="form-group">
  <div class="col-md-12">
    {{ Form::label('office','Office') }}
    {{ Form::select('office',$office,isset($department->head_office) ? $department->head_office : old('office'),[
      'class'=>'form-control'
    ]) }}
  </div>
</div>
<div class="form-group">
  <div class="col-md-12">
    {{ Form::label('abbreviation','Department Code') }}
    {{ Form::text('abbreviation', isset($department->code) ? $department->code : old('abbreviation'),[
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
<div class="form-group">
  <div class="col-md-12">
    {{ Form::label('head','Department Head') }}
    {{ Form::text('head', isset($department->head) ? $department->head : old('head'),[
      'class'=>'form-control',
      'placeholder'=>'Department Head'
    ]) }}
  </div>
</div>
<div class="form-group">
  <div class="col-md-12">
    {{ Form::label('designation','Designation') }}
    {{ Form::text('designation', isset($department->head_title) ? $department->head_title : old('designation'),[
      'class'=>'form-control',
      'placeholder'=>'Designation'
    ]) }}
  </div>
</div>