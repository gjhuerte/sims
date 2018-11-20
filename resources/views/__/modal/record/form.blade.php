<div class="modal fade" id="recordFormModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Transaction Information</h4>
      </div>
      <div class="modal-body">
          <div class="list-group">
            <a href="#" class="list-group-item">
              <h4 class="list-group-item-heading">Date Received</h4>
              <p class="list-group-item-text"><span id="modal-date">Loading Date Received...</span></p>
            </a>
            <a href="#" class="list-group-item">
              <h4 class="list-group-item-heading">Reference ( P.O. , R.I.S., A.P.R. ):</h4>
              <p class="list-group-item-text"><span id="modal-reference">Loading Reference...</span></p>
            </a>
            <a href="#" class="list-group-item">
              <h4 class="list-group-item-heading">Receipt ( D.R. , Invoice ):</h4>
              <p class="list-group-item-text"><span id="modal-receipt">Loading Receipt...</span></p>
            </a>
            <a href="#" class="list-group-item">
              <h4 class="list-group-item-heading">Office/Supplier</h4>
              <p class="list-group-item-text"><span id="modal-organization">Loading Office/Supplier...</span></p>
            </a>
            <a href="#" class="list-group-item">
              <h4 class="list-group-item-heading">Stock Number : <span id="modal-stocknumber">Loading Stock Number...</span></h4>
              <p class="list-group-item-text"><span id="modal-details"></span></p>
            </a>
            <a href="#" class="list-group-item">
              <h4 class="list-group-item-heading">Quantity</h4>
              <p class="list-group-item-text">Received: <span id="modal-received-quantity">Loading Received Quantity....</span></p>
              <p class="list-group-item-text">Issued: <span id="modal-issued-quantity">Loading Issued Quantity....</span></p>
            </a>
          </div>
        <div class="form-group">
          <label>Unit Price</label>
          <input type="text" class="form-control" placeholder="Unit Price" value="" name="unitcost" id="unitcost" required />
        </div>
        <div class="form-group" id="fundcluster-form">
          <label>Fund Cluster</label>
          <p style="font-size: 13px;">Separate each cluster by comma</p>
          <input type="text" class="form-control" placeholder="Fund Cluster" value="" name="fundcluster" id="fundcluster" required />
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="id" value="" id="record-id" />
        <input type="hidden" name="id" value="" id="record-received" />
        <input type="hidden" name="id" value="" id="record-issued" />
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="copy-record" type="button" class="btn btn-primary">Apply to Ledger Card</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){

    $('#recordFormModal').on('hidden.bs.modal', function(){
      $('#unitcost').val("").closest('.form-group').removeClass('has-error')
      $('#fundcluster').val("").closest('.form-group').removeClass('has-error')
    })

  })
</script>