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
        Schema::create('corretors', function (Blueprint $table) {
            $table->id();
            $table -> string('nome');
            $table->char('cpf', 11); // Define um campo de 11 caracteres fixos
            $table -> string('creci');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('corretors');
    }
};
