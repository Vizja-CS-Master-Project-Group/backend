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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('language')->index();
            $table->string('isbn')->index()->unique();
            $table->text('subject');

            $table->foreignId('author_id')->index()->nullable();
            $table->dateTime('authored_at')->nullable();

            $table->foreignId('publisher_id')->index()->nullable();
            $table->dateTime('published_at')->nullable();

            $table->integer('page_count');
            $table->boolean('original');
            $table->boolean('barrowable');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
