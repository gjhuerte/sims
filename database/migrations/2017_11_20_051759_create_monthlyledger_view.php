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
          create view monthlyledger_v as
          SELECT
            max(date) as date,
            stocknumber,
            sum(receivedquantity) AS receivedquantity,
            avg(receivedunitprice) AS receivedunitprice,
            sum(issuedquantity) AS issuedquantity,
            avg(issuedunitprice) AS issuedunitprice
          FROM
            ledgercards
          GROUP BY
            YEAR (date),
            MONTH (date), 
            stocknumber 
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
