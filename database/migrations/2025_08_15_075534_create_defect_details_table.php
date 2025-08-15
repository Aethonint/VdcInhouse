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
        Schema::create('defect_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('defect_id');
   
$table->string('is_defect')->nullable();

    $table->text('note')->nullable();
    $table->string('image_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('defect_details');
    }
};
