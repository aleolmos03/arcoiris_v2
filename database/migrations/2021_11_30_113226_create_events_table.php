<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('title');
            $table->text('description');
            $table->dateTime('star_date');
            $table->dateTime('end_date');
            $table->mediumInteger('maximum_capacity');
            $table->char('state', 1);
            $table->integer('address_id')->unsigned();
            $table->tinyInteger('event_type_id')->unsigned();
            $table->timestamps();
            $table->bigInteger('created_by')->unsigned();

            //Relation
            $table->foreign('address_id')->references('id')->on('addresses')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('event_type_id')->references('id')->on('event_types')
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
        Schema::dropIfExists('events');
    }
}
