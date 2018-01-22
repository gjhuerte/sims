<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficesAddDepartmentColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offices', function(Blueprint $table)
        {
            $table->integer('department_id')->unsigned()->nullable();
            $table->foreign('department_id')
                    ->references('id')
                    ->on('departments')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offices', function(Blueprint $table)
        {
            $table->dropForeign('offices_department_id_foreign');
            $table->dropColumn('department_id');
        });
    }
}
