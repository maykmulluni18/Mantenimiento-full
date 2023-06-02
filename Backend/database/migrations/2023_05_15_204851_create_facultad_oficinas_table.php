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
        Schema::create('facultad_oficinas', function (Blueprint $table) {
            $table->id();
            $table->string('cod_facultadOfi');
            $table->string('nombre_facultad_oficina');
            $table->string('nombre_escuela');
            $table->unsignedBigInteger('ambientes_id')->nullable();
            $table->foreign('ambientes_id')->references('id')->on('ambientes')
            ->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facultad_oficinas');
    }
};
