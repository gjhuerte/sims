<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUacsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE VIEW uacs_v AS
            SELECT
                purchaseorders.date_received AS date_received,
                supplies.stocknumber AS stocknumber,
                purchaseorders.number as purchaseorder_number,
                receipts.number as receipt_number,
                receipts.invoice as invoice,
                purchaseorders_supplies.unitcost as purchaseorder_unitcost,
                purchaseorders_supplies.received_quantity as purchaseorder_quantity,
                receipts_supplies.unitcost as receipt_unitcost,
                receipts_supplies.quantity as receipt_quantity,
                supplies.details AS details,
                units.name AS unit_name,
                categories.name AS category_name,
                categories.uacs_code AS uacs_code,
                fundclusters.code AS fundcluster_code
            FROM
                receipts
            LEFT JOIN 
                receipts_supplies 
            ON 
                receipts.id = receipts_supplies.receipt_id
            LEFT JOIN 
                purchaseorders 
            ON 
                receipts.purchaseorder_id = purchaseorders.id
            LEFT JOIN 
                purchaseorders_supplies 
            ON 
                purchaseorders.id = purchaseorders_supplies.purchaseorder_id
            LEFT JOIN 
                supplies 
            ON 
                receipts_supplies.supply_id = supplies.id
            LEFT JOIN 
                categories 
            ON 
                supplies.category_id = categories.id
            LEFT JOIN 
                units 
            ON 
                supplies.unit_id = supplies.id
            LEFT JOIN 
                purchaseorders_fundclusters 
            ON 
                purchaseorders_fundclusters.purchaseorder_id = purchaseorders.id
            LEFT JOIN 
                fundclusters 
            ON 
                purchaseorders_fundclusters.fundcluster_id = fundclusters.id
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("drop view if exists uacs_v");
    }
}
