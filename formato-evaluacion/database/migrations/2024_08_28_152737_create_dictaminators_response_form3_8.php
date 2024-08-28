<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dictaminators_response_form3_8', function (Blueprint $table) {

            $table->bigInteger('dictaminador_id')->unsigned();
            $table->unsignedBigInteger('user_id');
            $table->primary('dictaminador_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('email');
            $table->foreign('email')->references('email')->on('users')->onDelete('cascade');
            $table->decimal('score3_8', 8, 2);
            $table->decimal('comisionDict3_8', 8, 2);
            $table->decimal('puntaje3_8', 8, 2);
            $table->decimal('puntajeHoras3_8', 8, 2);
            $table->decimal('comision3_8', 8, 2);
            $table->string('obs3_8_1')->default('sin comentarios'); // Default value

            $table->enum('user_type', ['docente', 'dictaminador', ''])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dictaminators_response_form3_8');
    }
};
