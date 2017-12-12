<div class="modal fade" id="addStockNumberModal" tabindex="-1" role="dialog" aria-labelledby="addStockNumberModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 style="color:#337ab7;" class="line-either-side">Supply Inventory</h3>
          <p class="text-muted">* Select an item from the list below</p>
          <p class="text-primary">* You can use the search bar for convenience</p>
          <p class="text-primary">* Click the select button of your desired supply</p>
      		<table class="table table-hover table-striped table-bordered table-condensed" id="supplyInventoryTable" width=100%>
      			<thead>
      				<th class="col-sm-1">Stock No.</th>
      				<th class="col-sm-1">Details</th>
              <th class="col-sm-1">Unit</th>
      				<th class="col-sm-1 no-sort"></th>
      			</thead>
      		</table>
      </div> <!-- end of modal-body -->
    </div> <!-- end of modal-content -->
  </div>
</div>
<script>
  $(document).ready(function(){

      var table = $('#supplyInventoryTable').DataTable({
        language: {
            searchPlaceholder: "Search..."
        },
        "processing": true,
        ajax: "{{ url('inventory/supply') }}",
        columns: [
            { data: "stocknumber" },
            { data: "details" },
            { data: "unit" },
            { data: function(callback){
              return `
                <button type="button" id="select-stocknumber" data-id="`+callback.stocknumber+`" class="add-stock btn btn-sm btn-primary btn-block">Select</button>
              `;
            } }
        ],
      });
      
  })
</script>