<div class="modal fade" id="recordFormModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Copy Record</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Unit Price</label>
          <input type="text" class="form-control" placeholder="Unit Price" value="" name="unitprice" id="unitprice" required />
        </div>
        <div class="form-group">
          <label>Fund Cluster</label>
          <p style="font-size: 13px;">Separate each cluster by comma</p>
          <input type="text" class="form-control" placeholder="Fund Cluster" value="" name="fundcluster" id="fundcluster" required />
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="copy" type="button" class="btn btn-primary">Copy</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    $('#recordFormModal').on('hidden.bs.modal', function(){
      $('#unitprice').val("").closest('.form-group').removeClass('has-error')
      $('#fundcluster').val("").closest('.form-group').removeClass('has-error')
    })

  })
</script>