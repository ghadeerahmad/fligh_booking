<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('from' , 255);
            $table->string('to' , 255);
            $table->string('company' , 255);
            $table->dateTime('off_time');
            $table->integer('adults_no')->default(0);
            $table->integer('child_no')->default(0);
            $table->text('notes')->nullable();
            $table->string('price' , 255)->nullable();
            $table->string('currency' , 255)->default('USD');
            $table->boolean('oneWay')->default(true);
            $table->dateTime('lastTicketingDate')->default(now());
            $table->string('arrivalTerminal' , 128)->default('Not Specified!');
            $table->string('duration' , 128)->default('Not Specified!');
            $table->string('stops' , 128)->default('Not Specified!');
            $table->string('status' , 128)->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flights');
    }
}
