<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_controls', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->dateTime('date');
            $table->text('description');
            $table->boolean('assistance');//Si|NO
            $table->timestamps();
            $table->bigInteger('patient_id')->unsigned();
            $table->bigInteger('created_by')->unsigned();

            //Relation
            $table->foreign('patient_id')
                ->references('id')->on('patients')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('created_by')->references('id')->on('users')
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
        Schema::dropIfExists('medical_controls');
    }
}
