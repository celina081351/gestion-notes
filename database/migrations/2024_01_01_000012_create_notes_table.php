<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id('id_note');
            $table->foreignId('id_etudiant')->constrained('etudiants', 'id_etudiant')->onDelete('cascade');
            $table->foreignId('id_matiere')->constrained('matieres', 'id_matiere')->onDelete('cascade');
            $table->decimal('valeur', 5, 2);
            $table->date('date_saisie');
            $table->string('semestre', 20);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
