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
        /*
            TABLA CATALINA PARA LAS TAREAS DEL USUARIO
            TIENE LA FK PARA CONECTAR LA TABLA CON LA DE USUARIOS
        */
        Schema::create('tasks', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->timestamps();
            $table->string('title')->required();
            $table->string('description')->nullable();
            $table->boolean('completed')->nullable()->default(false);
            $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
