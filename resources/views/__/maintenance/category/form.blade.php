<div class="form-group">
  <div class="col-md-12">
    {{ Form::label('code','UACS Code') }}
    {{ Form::text('code', isset($category->uacs_code) ? $category->uacs_code : old('code') ,[
      'class'=>'form-control',
      'placeholder'=>'UACS Code'
    ]) }}
  </div>
</div>
<div class="form-group">
  <div class="col-md-12">
    {{ Form::label('name','Category Name') }}
    {{ Form::text('name', isset($category->name) ? $category->name : old('name'),[
      'class'=>'form-control',
      'placeholder'=>'Category Name'
    ]) }}
  </div>
</div>