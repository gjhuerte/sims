<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonthlyledgerView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
          CREATE VIEW monthlyledger_v AS
          SELECT
                max(reference) as reference,
                max(date) as date,
                supplies.stocknumber,
                sum(received_quantity) AS received_quantity,
                avg(received_unitcost) AS received_unitcost,
                sum(issued_quantity) AS issued_quantity,
                avg(issued_unitcost) AS issued_unitcost,
                avg(daystoconsume) as daystoconsume
            FROM
                ledgercards
            LEFT JOIN 
                supplies
            ON
                supplies.id = ledgercards.supply_id
          GROUP BY
                YEAR (date),
                MONTH (date), 
                supplies.stocknumber 
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("drop view if exists monthlyledger_v");
    }
}
