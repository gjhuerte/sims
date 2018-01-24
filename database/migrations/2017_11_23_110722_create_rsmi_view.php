<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRsmiView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE VIEW rsmi_v AS
            SELECT 
                    stockcards.id,
                    stockcards.date,
                    stockcards.created_at,
                    stockcards.reference ,
                    stockcards.organization as office,
                    supplies.stocknumber,
                    supplies.details,
                    units.name ,
                    stockcards.issued_quantity,
                    ledgercards.issued_unitcost as cost
            FROM stockcards
            LEFT JOIN 
                supplies
            ON 
                supplies.id = stockcards.supply_id 
            LEFT JOIN 
                units
            ON 
                units.id = supplies.unit_id 
            LEFT JOIN 
                ledgercards 
            on 
                ledgercards.supply_id = stockcards.supply_id 
                and 
                    ledgercards.reference = stockcards.reference
            WHERE stockcards.issued_quantity > 0 
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("drop view if exists rsmi_v");
    }
}
