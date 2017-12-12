<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('table_affected');
            $table->string('column')->nullable();
            $table->string('action')->nullable();  
            $table->string('user')->nullable();
            $table->longtext('initial')->nullable();
            $table->longtext('succeeding')->nullable();
            $table->longtext('details');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('audits');
    }
}