<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('DNI', 8);
            $table->string('name');
            $table->string('last_name');
            $table->string('nick_name');
            $table->char('sex', 1);// [M]asculino/[F]emenino
            $table->date('date_of_birth');
            $table->char('state', 1);// [A]Activo/[P]cambio de pass
            $table->string('file',128)->nullable();//para subir las imagenes
            $table->tinyInteger('blood_type_id')->unsigned();
            $table->integer('address_id')->unsigned();
            $table->timestamps();
            $table->bigInteger('created_by')->unsigned();

            //Relation
            $table->foreign('created_by')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('blood_type_id')->references('id')->on('blood_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('address_id')->references('id')->on('addresses')
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
        Schema::dropIfExists('people');
    }
}
