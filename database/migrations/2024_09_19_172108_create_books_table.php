<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id(); // Campo ID
            $table->string('titulo', 100); // Campo título
            $table->string('public_en', 100)->nullable(); // Campo lugar de publicación 
            $table->foreignId('id_author')
                  ->constrained('authors')
                  ->onUpdate('cascade')
                  ->onDelete('restrict'); // Relación con la tabla authors
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
