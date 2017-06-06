<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeParticularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_particular', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_id');
            $table->string('salary_scale');
            $table->string('employment_date');   
            $table->string('confirmation_date');
            $table->string('current_occupation');
            $table->string('retirement_date');
            $table->string('propotion_date');                    
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
        Schema::dropIfExists('employee_particular');
    }
}
