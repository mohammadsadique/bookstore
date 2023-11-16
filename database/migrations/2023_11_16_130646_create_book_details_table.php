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
        Schema::create('book_details', function (Blueprint $table) {
            $table->id();
            $table->string('publisher')->nullable();
            $table->string('title')->nullable();
            $table->string('author')->nullable();
            $table->string('genre')->nullable();
            $table->text('description')->nullable();
            $table->string('isbn')->nullable();
            $table->string('image')->nullable();
            $table->date('published')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_details');
    }
};
