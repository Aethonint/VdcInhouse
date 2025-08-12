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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
               $table->unsignedBigInteger('user_id'); // Just store the ID, no FK constraint
        $table->string('job_title');
        $table->date('dob');
        $table->date('start_date');
        $table->date('end_date')->nullable();
        $table->string('license_number')->nullable();
        $table->string('employee_no');
        $table->decimal('hourly_rate', 8, 2);
        $table->text('address');
        $table->boolean('is_operator')->default(false);
        $table->boolean('is_employee')->default(false);
        $table->boolean('is_technician')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
