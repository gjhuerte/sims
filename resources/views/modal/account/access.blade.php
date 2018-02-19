<div class="modal fade" id="changeAccessLevelModal" tabindex="-1" role="dialog" aria-labelledby="changeAccessLevelModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <ul style='margin-left: 10px;'>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
          </ul>
        </div>
      @endif
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 style="color:#337ab7;">Change Access Level</h3>
      </div>
      <div class="modal-body">
        {{ Form::open(['method'=>'PUT','route'=>('account.accesslevel.update')]) }}
          {{ Form::hidden('id',null,[
            'id' => 'accesslevel-id'
          ]) }}
        <div class="form-group">
          {{ Form::label('accesslevel-name','Name') }}
          {{ Form::text('name',null,[
            'class'=>'form-control',
            'style' => 'background-color: white;',
            'id' => 'accesslevel-name',
            'readonly'
          ]) }}
        </div>
        <div class="form-group">
          {{ Form::label('accesslevel-oldaccesslevel','Current Access Level') }}
          {{ Form::text('oldaccesslevel',null,[
            'class'=>'form-control',
            'style' => 'background-color: white;',
            'id' => 'accesslevel-oldaccesslevel',
            'readonly'
          ]) }}
        </div>
        <label for="newaccesslevel">New Access Level</label>
        <div class="form-group">
          <ul class="list-group">

            @foreach(App\User::$access_list as $key=>$value)
            <li class="list-group-item">
              <div class="radio">
                <label>
                  <input type="radio" name="newaccesslevel" value="{{ $key }}">
                  {{ $value }}
                </label>
              </div>
            </li>
            @endforeach
          </ul>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-lg btn-block">Update</button>
        </div>
        {{ Form::close() }}
      </div> <!-- end of modal-body -->
    </div> <!-- end of modal-content -->
  </div>
</div>
<script>
  $(document).ready(function(){

  });
</script>
