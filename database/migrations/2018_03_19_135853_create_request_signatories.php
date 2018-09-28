<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestSignatories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests_signatories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_id');
            $table->string('requestor_name');
            $table->string('requestor_designation');
            $table->string('approver_name');
            $table->string('approver_designation');
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
        Schema::dropIfExists('request_signatories');
    }
}
