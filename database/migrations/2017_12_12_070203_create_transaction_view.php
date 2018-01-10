<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE VIEW transaction_v AS
            SELECT 
                stockcards.id as id,
                stockcards.date as date,
                stockcards.reference as reference ,
                stockcards.organization as office,
                supplies.id as supply_id,
                supplies.stocknumber as stocknumber,
                supplies.details as supply_details,
                units.id as unit_id,
                units.name as unit_name,
                stockcards.issued_quantity as issued_quantity,
                ledgercards.issued_unitcost as issued_unitcost
            FROM 
                stockcards
            LEFT JOIN 
                supplies 
            ON 
                supplies.id = stockcards.supply_id 
            LEFT JOIN 
                units
            ON 
                units.id = supplies.unit_id 
            RIGHT JOIN 
                ledgercards 
            on ledgercards.supply_id = stockcards.supply_id 
                and ledgercards.reference = stockcards.reference
                and ledgercards.reference = stockcards.reference 
                and stockcards.received_quantity = ledgercards.received_quantity
                and stockcards.issued_quantity = ledgercards.issued_quantity 
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("drop view if exists transaction_v");
    }
}
