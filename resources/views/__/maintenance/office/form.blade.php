
<div class="form-group">
  <div class="col-md-12">
    {{ Form::label('code','Office Code') }}
    {{ Form::text('code', isset($office->code) ? $office->code : old('code'),[
      'class'=>'form-control',
      'placeholder'=>'Office Code'
    ]) }}
  </div>
</div>
<div class="form-group">
  <div class="col-md-12">
    {{ Form::label('name','Office Name') }}
    {{ Form::text('name', isset($office->name) ? $office->name : old('name'),[
      'class'=>'form-control',
      'placeholder'=>'Office Name'
    ]) }}
  </div>
</div>
<div class="form-group">
  <div class="col-md-12">
    {{ Form::label('description','Description') }}
    {{ Form::text('description', isset($office->description) ? $office->description : old('description'),[
      'class'=>'form-control',
      'placeholder'=>'Description'
    ]) }}
  </div>
</div>
<div class="form-group">
  <div class="col-md-12">
    {{ Form::label('head','Head') }}
    {{ Form::text('head', isset($office->head) ? $office->head : old('head'),[
      'class'=>'form-control',
      'placeholder'=>'Full Name'
    ]) }}
  </div>
</div>
<div class="form-group">
  <div class="col-md-12">
    {{ Form::label('head_title','Designation') }}
    {{ Form::text('head_title', isset($office->head_title) ? $office->head_title : old('head_title'),[
      'class'=>'form-control',
      'placeholder'=>'Designation'
    ]) }}
  </div>
</div>