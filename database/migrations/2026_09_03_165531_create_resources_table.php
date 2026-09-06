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
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('roadmap_id')
                ->constrained('roadmaps')
                ->cascadeOnDelete();
            $table->string('title');
            $table->text('url');
            $table->enum('type', [
                'video',
                'documentation',
                'article',
                'link',
                'other',
            ]);
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
