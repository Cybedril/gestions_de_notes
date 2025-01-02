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
        Schema::create('u_e_s', function (Blueprint $table) {
            $table->id(); // Clé primaire
            $table->string('code')->unique(); // Code de l'UE (ex: UE11)
            $table->string('nom'); // Nom de l'UE
            $table->integer('credits_ects'); // Crédits ECTS de l'UE
            $table->integer('semestre'); // Semestre (1 à 6)
            $table->timestamps(); // Date de création et mise à jour
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('u_e_s');
    }
};
