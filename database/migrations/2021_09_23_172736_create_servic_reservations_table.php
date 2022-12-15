<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('servic_reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('servic_id')->constrained('servics')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('birthday');
            $table->string('bank');
            $table->string('education');
            $table->string('work');
            $table->string('account_type');
            $table->string('other_passport');
            $table->string('other_resdince');
            $table->string('gender');
            $table->string('married');
            $table->string('destination')->nullable();
            $table->string('age');
            $table->string('staying_time')->nullable();
            $table->string('diseases')->nullable();
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
        Schema::dropIfExists('servic_reservations');
    }
}
