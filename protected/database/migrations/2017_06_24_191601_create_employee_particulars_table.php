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
        Schema::create('employee_particulars', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id')->unsigned();
            $table->string('employment_type');
            $table->string('education');
            $table->date('employment_date');
            $table->integer('region_id')->unsigned();
            $table->integer('profession_id')->unsigned();
            $table->integer('prof_reg_status_id')->unsigned();
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees')
                  ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('region_id')->references('id')->on('regions')
                  ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('profession_id')->references('id')->on('professions')
                  ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('prof_reg_status_id')->references('id')->on('profession_registrations')
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
        Schema::dropIfExists('employee_particulars');
    }
}
