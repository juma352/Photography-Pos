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
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('filename');
            $table->string('original_filename');
            $table->string('alt_text')->nullable();
            $table->foreignId('collection_id')->constrained()->onDelete('cascade');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->json('metadata')->nullable(); // For EXIF data, dimensions, etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
