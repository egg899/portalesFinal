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
        Schema::create('blogs_have_categorias', function (Blueprint $table) {
            $table->foreignId('blogs_fk')->constrained(table: 'blogs', column: 'id');
            $table->unsignedSmallInteger('categoria_fk');
            $table->foreign('categoria_fk')->references('categoria_id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs_have_categorias');
    }
};
