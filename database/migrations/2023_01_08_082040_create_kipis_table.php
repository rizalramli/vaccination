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
        Schema::create('kipi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vaccination_id')->constrained('vaccination')->onDelete('cascade');
            $table->date('incident_date');
            $table->string('indication', 100);
            $table->string('action', 100);
            $table->boolean('is_contact_doctor');
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
        Schema::dropIfExists('kipi');
    }
};
