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
        Schema::create('vaccination', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')->constrained('schedule')->onDelete('cascade');
            $table->foreignId('employee_id')->constrained('employee')->onDelete('cascade');
            $table->integer('vaccination_number')->nullable();
            $table->dateTime('vaccination_date')->nullable();
            $table->date('next_vaccination_date')->nullable();
            $table->boolean('is_vaccinated')->default(false);
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
        Schema::dropIfExists('vaccination');
    }
};
