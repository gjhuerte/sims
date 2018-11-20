<div class="form-group">
  <div class="col-md-12">
    {{ Form::label('name','Name') }}
    {{ Form::text('name', isset($supplier->name) ? $supplier->name : old('name'),[
      'class'=>'form-control',
      'placeholder'=>'Name'
    ]) }}
  </div>
</div>
<div class="form-group">
  <div class="col-md-12">
    {{ Form::label('address','Address') }}
    {{ Form::textarea('address', isset($supplier->address) ? $supplier->address : old('address'),[
      'class'=>'form-control',
      'placeholder'=>'Suppliers Address',
      'rows' => 4
    ]) }}
  </div>
</div>
<div class="form-group">
  <div class="col-md-12">
    {{ Form::label('contact','Contact Number') }}
    {{ Form::text('contact', isset($supplier->contact) ? $supplier->contact : old('contact'),[
      'class'=>'form-control',
      'placeholder'=>'Contact Number'
    ]) }}
  </div>
</div>
<div class="form-group">
  <div class="col-md-12">
    {{ Form::label('website','Website') }}
    {{ Form::text('website', isset($supplier->website) ? $supplier->website : old('website'),[
      'class'=>'form-control',
      'placeholder'=>'Website'
    ]) }}
  </div>
</div>
<div class="form-group">
  <div class="col-md-12">
    {{ Form::label('email','Email Address') }}
    {{ Form::email('email', isset($supplier->email) ? $supplier->email : old('email'),[
      'class'=>'form-control',
      'placeholder'=>'Email'
    ]) }}
  </div>
</div>