<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->bigInteger('person_id')->unsigned();
            $table->boolean('internship');
            $table->string('diaper_size');
            $table->string('upper_indumetary_size', 8);
            $table->string('alower_indumetary_size', 8);
            $table->string('shoe_size', 8);
            $table->date('start_treatment');
            $table->date('end_treatment')->nullable();
            $table->bigInteger('diagnose_id')->unsigned();

            //Relation
            $table->foreign('person_id')->references('id')->on('people')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('diagnose_id')->references('id')->on('diagnoses')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
