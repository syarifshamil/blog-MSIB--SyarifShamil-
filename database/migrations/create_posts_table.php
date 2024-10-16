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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Kolom untuk judul post
            $table->text('content'); // Kolom untuk isi konten post
            $table->string('image')->nullable(); // Kolom untuk menyimpan gambar, opsional
            $table->boolean('is_published')->default(false); // Status apakah post sudah dipublish
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // Foreign key ke tabel categories
            $table->timestamps(); // Kolom untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }

};
