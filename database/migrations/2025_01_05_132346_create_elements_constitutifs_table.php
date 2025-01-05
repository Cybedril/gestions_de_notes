<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('elements_constitutifs', function (Blueprint $table) {
            $table->id(); // Crée une colonne id de type BIGINT
            $table->string('code')->unique(); // Crée une colonne code unique
            $table->string('nom'); // Crée une colonne nom
            $table->integer('coefficient'); // Crée une colonne coefficient
            $table->foreignId('ue_id') // Crée une colonne ue_id qui est une clé étrangère
                ->constrained('u_e_s') // Fait référence à la table u_e_s
                ->onDelete('cascade'); // Supprime les éléments associés si un enregistrement de u_e_s est supprimé
            $table->timestamps(); // Crée les colonnes created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('elements_constitutifs');
    }
};


