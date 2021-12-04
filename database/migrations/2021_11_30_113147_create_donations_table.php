<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->dateTime('date');
            $table->text('description');
            $table->tinyInteger('quantity');
            $table->tinyInteger('donation_type_id')->unsigned();
            $table->timestamps();
            $table->bigInteger('patient_id')->unsigned();
            $table->bigInteger('created_by')->unsigned();

            //Relation
            $table->foreign('donation_type_id')->references('id')->on('donation_types')
              ->onDelete('cascade')
              ->onUpdate('cascade');

            $table->foreign('patient_id')->references('id')->on('patients')
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
        Schema::dropIfExists('donations');
    }
}
