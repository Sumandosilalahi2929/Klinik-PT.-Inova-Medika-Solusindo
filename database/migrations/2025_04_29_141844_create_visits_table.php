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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patients_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('employees_id')->constrained('employees')->onDelete('cascade');
            $table->timestamp('date_visit');
            $table->enum('type_visit', ['umum', 'laboratorium']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
