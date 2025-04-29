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
        Schema::create('patient_medications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patients_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('visits_id')->constrained('visits')->onDelete('cascade');
            $table->foreignId('drugs_id')->constrained('drugs')->onDelete('cascade');
            $table->string('notes')->nullable();
            $table->string('dosage');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_medications');
    }
};
