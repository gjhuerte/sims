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
                stockcards.id,
                stockcards.date,
                stockcards.reference ,
                stockcards.organization as office,
                stockcards.stocknumber,
                supplies.details,
                supplies.unit ,
                stockcards.issued,
                ledgercards.issuedunitprice as cost
            FROM stockcards
            LEFT JOIN supplies ON supplies.stocknumber = stockcards.stocknumber 
            RIGHT JOIN ledgercards on ledgercards.stocknumber = stockcards.stocknumber and ledgercards.reference = stockcards.reference
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
