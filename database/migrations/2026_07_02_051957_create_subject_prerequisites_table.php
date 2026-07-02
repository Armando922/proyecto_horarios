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
        Schema::create('subject_prerequisites', function (Blueprint $table) {
            $table->id();

            // Materia que requiere un prerrequisito
            $table->foreignId('subject_id')
                ->constrained('subjects')
                ->cascadeOnDelete();

            // Materia que actúa como prerrequisito
            $table->foreignId('prerequisite_subject_id')
                ->constrained('subjects')
                ->cascadeOnDelete();

            $table->timestamps();

            // Evita registrar el mismo prerrequisito dos veces
            $table->unique(['subject_id', 'prerequisite_subject_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_prerequisites');
    }
};
