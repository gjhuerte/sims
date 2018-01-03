<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficesPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offices_positions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('office_id')->unsigned()->nullable();
            $table->foreign('office_id')
                    ->references('id')
                    ->on('offices')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->string('title',50)->unique();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('offices_positions');
    }
}
