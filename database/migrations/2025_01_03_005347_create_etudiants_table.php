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
            $table->string('numero_etudiant')->unique();
            $table->string('nom');
            $table->string('prenom');
            $table->string('niveau'); // L1, L2, L3
            $table->timestamps();
        });
    }

    
    
    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};
