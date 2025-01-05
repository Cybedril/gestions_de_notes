<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_etudiant')->default(0)->change();
            $table->string('matricule')->default();
            $table->string('nom');
            $table->string('prenom');
            $table->string('niveau')->default('L1');
            $table->string('sexe')->nullable();  // Ajoutez la colonne sexe
            $table->timestamps();
        });
    }

    
    
    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};
