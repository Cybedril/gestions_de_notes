<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('etudiant_id')->constrained('etudiants')->onDelete('cascade');
            $table->foreignId('ec_id')->constrained('elements_constitutifs')->onDelete('cascade');
            $table->decimal('note', 5, 2); // Note entre 0 et 20 avec deux décimales
            $table->enum('session', ['normale', 'rattrapage']);
            $table->date('date_evaluation')->nullable(); // Ajout de la date d'évaluation
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
