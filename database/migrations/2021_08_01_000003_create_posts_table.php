<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->commonFields();

            $table->json('title');
            $table->json('slug');
            $table->json('description');
            $table->string('layout')->default('default');
        });

        Schema::create('post_categories', function (Blueprint $table) {
            $table->commonFields(published: false);
            $table->json('title');
            $table->json('slug');
            $table->json('description');
        });

        Schema::create('category_post', function (Blueprint $table) {
            $table->id();

            $table->foreignId('post_category_id')
                ->constrained('post_categories')
                ->cascadeOnDelete();

            $table->foreignId('post_id')
                ->constrained('posts')
                ->cascadeOnDelete();
        });
    }
};
