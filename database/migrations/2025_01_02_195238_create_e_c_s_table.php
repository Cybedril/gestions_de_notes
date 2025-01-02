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
        Schema::create('e_c_s', function (Blueprint $table) {
            $table->id(); // Clé primaire
            $table->string('code'); // Code de l'EC
            $table->string('nom'); // Nom de l'EC
            $table->integer('coefficient'); // Coefficient de l'EC
            $table->foreignId('ue_id')->constrained('u_e_s'); // Clé étrangère vers `u_e_s` (UE)
            $table->timestamps(); // Date de création et mise à jour
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e_c_s');
    }
};
