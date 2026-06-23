<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('name');                     // Nombre del invitado / familia
            $table->string('slug')->unique();           // URL personalizada: /invitado/{slug}
            $table->integer('tickets')->default(1);     // Pases asignados
            $table->integer('confirmed_tickets')->nullable(); // Cuántos confirmaron
            $table->boolean('confirmed')->default(false);     // Si confirmó asistencia
            $table->string('table_name')->nullable();   // Nombre de mesa asignada
            $table->string('seats')->nullable();        // Número(s) de asiento(s)
            $table->string('video_url')->nullable();    // Video personalizado (URL YouTube/Vimeo)
            $table->text('notes')->nullable();          // Notas del admin
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
