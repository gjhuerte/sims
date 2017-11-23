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
          select
          date,
          stocknumber,
          sum(receivedquantity) as receivedquantity,
          avg(receivedunitprice) as receivedunitprice,
          sum(issuedquantity) as issuedquantity,
          avg(issuedunitprice) as issuedunitprice
        from ledgercards
        GROUP BY
          year(date),
          month(date),  
          date,
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
