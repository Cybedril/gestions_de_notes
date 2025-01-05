<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('etudiant_id')
                ->constrained('etudiants')
                ->onDelete('cascade');
            $table->foreignId('ec_id')
                ->constrained('e_c_s')
                ->onDelete('cascade');
            $table->foreignId('ue_id')
                ->constrained('u_e_s')
                ->onDelete('cascade');
            $table->decimal('note', 5, 2);
            $table->enum('session', ['normale', 'rattrapage']);
            $table->date('date_evaluation');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notes');
    }
}
