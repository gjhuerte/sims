<div class="form-group">
  <div class="col-md-12">
    {{ Form::label('title','Title') }}
    {{ Form::text('title', isset($announcement->title) ? $announcement->title : old('title'),[
      'class'=>'form-control',
      'placeholder'=>'Title'
    ]) }}
  </div>
</div>
<div class="form-group">
  <div class="col-md-12">
    {{ Form::label('details','Details') }}
    {{ Form::textarea('details', isset($announcement->details) ? $announcement->details : old('details'),[
      'class'=>'form-control',
      'placeholder'=>'Details',
      'rows' => 4
    ]) }}
  </div>
</div>
<div class="form-group">
  <div class="col-md-12">
    {{ Form::label('access','Access') }}
    <p class="text-muted"> The target users for this announcement </p>
    {{ Form::select('access', (isset($access_list) && count($access_list) > 0) ? $access_list : [],isset($announcement->access) ? $announcement->access : old('access'),[
      'class'=>'form-control'
    ]) }}
  </div>
</div>