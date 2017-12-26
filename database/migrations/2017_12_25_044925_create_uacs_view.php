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
            SELECT
                purchaseorders.date_received AS date_received,
                supplies.stocknumber AS stocknumber,
                purchaseorders.number as purchaseorder_number,
                receipts.number as receipt_number,
                receipts.invoice as invoice,
                purchaseorders_supplies.unitcost as purchaseorder_unitcost,
                receipts_supplies.cost as receipts_supplies,
                supplies.details AS details,
                supplies.category_name AS category_name,
                categories.uacs_code AS uacs_code,
                purchaseorders_fundclusters.fundcluster_code AS fundcluster_code
            FROM
                receipts
            LEFT JOIN receipts_supplies ON receipts.number = receipts_supplies.receipt_number
            LEFT JOIN purchaseorders ON receipts.reference = purchaseorders.number
            LEFT JOIN purchaseorders_supplies ON purchaseorders.number = purchaseorders_supplies.purchaseorder_number
            LEFT JOIN supplies ON receipts_supplies.stocknumber = supplies.stocknumber
            LEFT JOIN categories ON supplies.category_name = categories. NAME
            LEFT JOIN purchaseorders_fundclusters ON purchaseorders_fundclusters.purchaseorder_number = purchaseorders.number
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
