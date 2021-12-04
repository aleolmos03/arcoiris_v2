<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relatives', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->bigInteger('person_id')->unsigned();
            $table->boolean('keeper');//Si|No
            $table->string('phone1', 20)->nullable();
            $table->string('phone2', 20)->nullable();
            $table->string('mobile1', 20)->nullable();
            $table->string('mobile2', 20)->nullable();
            $table->tinyInteger('relationship_id')->unsigned();
            $table->bigInteger('patient_id')->unsigned();

            //Relation
            $table->foreign('person_id')->references('id')->on('people')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('relationship_id')->references('id')->on('relationships')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('patient_id')->references('id')->on('patients')
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
        Schema::dropIfExists('relatives');
    }
}
