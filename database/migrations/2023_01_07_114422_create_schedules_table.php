<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vaccinator_id')->constrained('vaccinator')->onDelete('cascade');
            $table->foreignId('vaccine_type_id')->constrained('vaccine_type')->onDelete('cascade');
            $table->string('organizer', 100);
            $table->date('registration_date_start');
            $table->date('registration_date_end');
            $table->date('implementation_date');
            $table->time('implementation_time_start');
            $table->time('implementation_time_end');
            $table->string('location', 100);
            $table->integer('quota');
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
        Schema::dropIfExists('schedule');
    }
};
