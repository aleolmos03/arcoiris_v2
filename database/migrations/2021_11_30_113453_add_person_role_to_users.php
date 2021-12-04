<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPersonRoleToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('person_id')->unsigned();
            $table->tinyInteger('role_id')->unsigned();
            $table->string('phone1', 20)->nullable();
            $table->string('phone2', 20)->nullable();
            $table->string('mobile1', 20)->nullable();
            $table->string('mobile2', 20)->nullable();
            $table->string('occupation')->nullable();
            $table->text('curriculum_vitae')->nullable();
            $table->date('start_activitiest')->nullable();
            $table->date('end_activitiest')->nullable();

            //Relation
            $table->foreign('person_id')->references('id')->on('people')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('role_id')->references('id')->on('roles')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }
}
