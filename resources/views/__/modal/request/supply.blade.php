<div class="modal fade" id="addStockNumberModal" tabindex="-1" role="dialog" aria-labelledby="addStockNumberModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 style="color:#337ab7;" class="line-either-side">Supply Inventory</h3>
          <p class="text-muted">* Select an item from the list below</p>
          <p class="text-primary">* You can use the search bar for convenience</p>
          <p class="text-primary">* Click the select button of your desired supply</p>
      		<table class="table table-hover table-striped table-bordered table-condensed" id="supplyInventoryTable" width=100%>
      			<thead>
      				<th class="col-sm-1">ID</th>
      				<th class="col-sm-1">Stock No.</th>
      				<th class="col-sm-1">Details</th>
              <th class="col-sm-1">Unit</th>
              @if(isset($action) && $action != 'request')
              <th class="col-sm-1">Balance</th>
              @endif
              @if(Auth::user()->access == 3)
              <th class="col-sm-1">Availability</th>
      				@endif
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
        serverSide: true,
        language: {
            searchPlaceholder: "Search..."
        },
        "processing": true,
        ajax: "{{ url('inventory/supply') }}",
        "order": [
                  @if(Auth::user()->access == 3)
                  [ 4, "asc" ],
                  @endif
                  [ 1, "asc" ]
                  ],
        columns: [
            { data: "id" },
            { data: "stocknumber" },
            { data: "details" },
            { data: "unit_name" },
            @if(isset($action) && $action != 'request')

            @if(Auth::user()->access == 1 || Auth::user()->access == 2)

            {{-- check from where the balance will be used --}}
            @if(isset($type) && $type == 'ledger')
            { data: "ledger_balance" },
            @elseif($action == 'approval')
            { data: "temp_balance" },
            @else
            { data: "stock_balance" },
            @endif
            {{-- check from where the balance will be used --}}

            @endif
            @endif

            @if(Auth::user()->access == 3)
            { data: "availability" },
            @endif
            {data: function(callback){
                return `
                <button type="button" id="select-stocknumber" data-id="`+callback.stocknumber+`" class="add-stock btn btn-sm btn-primary btn-block"> Select</button>
              `;}}

        ],
        
      });

  })
</script>
