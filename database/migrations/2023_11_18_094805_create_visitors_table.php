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
        Schema::create('visitors', function (Blueprint $table) {
            $table->foreignUuid('patient_id')
                ->constrained('patients', 'id')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignUuid('doctor_id')
                ->constrained('doctors', 'id')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignUuid('medical_record_id')
                ->nullable()
                ->constrained('medical_records', 'id')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
