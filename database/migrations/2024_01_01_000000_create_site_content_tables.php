<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('categories')) {
            Schema::create('categories', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('album_categories')) {
            Schema::create('album_categories', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('news')) {
            Schema::create('news', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->longText('description');
                $table->string('category')->nullable();   // comma-separated category ids
                $table->string('banner')->nullable();
                $table->date('news_date')->nullable();
                $table->timestamps();
                $table->index('news_date');
            });
        }

        if (!Schema::hasTable('albums')) {
            Schema::create('albums', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->text('description')->nullable();
                $table->string('category')->nullable();   // comma-separated album category ids
                $table->string('cover_image')->nullable();
                $table->date('publishDate')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('album_images_details')) {
            Schema::create('album_images_details', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('albumId')->index();
                $table->unsignedInteger('sortIndex')->default(0);
                $table->string('caption')->nullable();
                $table->string('credit')->nullable();
                $table->string('fileName')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('images')) {
            Schema::create('images', function (Blueprint $table) {
                $table->id();
                $table->text('description')->nullable();
                $table->string('image');
                $table->unsignedBigInteger('album_id')->index();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        foreach (['images', 'album_images_details', 'albums', 'news', 'album_categories', 'categories'] as $t) {
            Schema::dropIfExists($t);
        }
    }
};
