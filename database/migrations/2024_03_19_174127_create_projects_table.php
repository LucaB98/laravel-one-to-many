<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->unique();
            $table->string('slug')->unique();
            $table->text('description');
            $table->boolean('is_completed');
            $table->string('image')->nullable();

            $table->timestamps();
            $table->softDeletes(); //evita l'eliminazione totale diretta dei dati dal server
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Storage::deleteDirectory('project_images');
        Schema::dropIfExists('projects');
    }
};
