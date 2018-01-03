
<div class="form-group">
  <div class="col-md-12">
    {{ Form::label('code','Department Code') }}
    {{ Form::text('code', isset($office->code) ? $office->code : old('code'),[
      'class'=>'form-control',
      'placeholder'=>'Department Code'
    ]) }}
  </div>
</div>
<div class="form-group">
  <div class="col-md-12">
    {{ Form::label('name','Organization Name') }}
    {{ Form::text('name', isset($office->name) ? $office->name : old('name'),[
      'class'=>'form-control',
      'placeholder'=>'Department Name'
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
    {{ Form::label('head','Organization Head') }}
    {{ Form::text('head', isset($office->head) ? $office->head : old('head'),[
      'class'=>'form-control',
      'placeholder'=>'Full Name'
    ]) }}
  </div>
</div>