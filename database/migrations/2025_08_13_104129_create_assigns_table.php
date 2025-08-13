<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assigns', function (Blueprint $table) {
            $table->id();
              // vehicle + operator (user)
            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('operator_id'); // users.id

            // times
            $table->dateTime('start_datetime')->nullable();
            $table->dateTime('end_datetime')->nullable();

            // odometers
            $table->unsignedBigInteger('starting_odometer')->nullable();
            $table->unsignedBigInteger('ending_odometer')->nullable();

            // notes
            $table->text('comment')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assigns');
    }
};
