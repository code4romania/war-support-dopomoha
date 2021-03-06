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
        Schema::table('blocks', function (Blueprint $table) {
            $table->fulltext('content');
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->fullText('title');
            $table->fullText('description');
        });
    }
};
