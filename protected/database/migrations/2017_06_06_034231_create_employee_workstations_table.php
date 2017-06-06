<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeWorkstationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_workstation', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_id');
            $table->string('region');
            $table->string('district');   
            $table->timestamps();
            $table->foreign('employee_id')->references('id')->on('employee')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_workstation');
    }
}
