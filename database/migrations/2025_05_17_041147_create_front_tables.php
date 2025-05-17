<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('libraries', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignUlid('user_id')->nullable()->constrained('users')->nullOnDelete();
      $table->string('title');
      $table->string('file_name');
      $table->string('file_path');
      $table->string('file_type')->default('image');
      $table->string('mime_type');
      $table->string('alt_text')->nullable();
      $table->bigInteger('size')->nullable();
      $table->integer('width')->nullable();
      $table->integer('height')->nullable();
      $table->timestamps();
    });

    Schema::create('posts', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignUlid('user_id')->nullable()->constrained()->nullOnDelete();
      $table->string('title');
      $table->string('slug')->unique();
      $table->text('excerpt')->nullable();
      $table->longText('content');
      $table->enum('type', ['post', 'page']);
      $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
      $table->foreignUlid('featured_library_id')->nullable()->constrained('libraries')->nullOnDelete();
      $table->timestamp('published_at')->nullable();
      $table->timestamps();
    });

    Schema::create('categories', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->string('name');
      $table->string('slug')->unique();
      $table->text('description')->nullable();
      $table->foreignUlid('parent_id')->nullable()->constrained('categories')->nullOnDelete();
      $table->timestamps();
    });

    Schema::create('tags', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->string('name');
      $table->string('slug')->unique();
      $table->text('description')->nullable();
      $table->timestamps();
    });

    Schema::create('post_category', function (Blueprint $table) {
      $table->foreignUlid('post_id')->constrained('posts')->cascadeOnDelete();
      $table->foreignUlid('category_id')->constrained('categories')->cascadeOnDelete();
      $table->primary(['post_id', 'category_id']);
    });

    Schema::create('post_tag', function (Blueprint $table) {
      $table->foreignUlid('post_id')->constrained('posts')->cascadeOnDelete();
      $table->foreignUlid('tag_id')->constrained('tags')->cascadeOnDelete();
      $table->primary(['post_id', 'tag_id']);
    });

    Schema::create('menus', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->string('name');
      $table->enum('location', ['top', 'main', 'footer']);
      $table->timestamps();
    });

    Schema::create('menu_items', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignUlid('menu_id')->constrained('menus')->cascadeOnDelete();
      $table->string('title');
      $table->string('url')->nullable();
      $table->integer('order')->default(0);
      $table->foreignUlid('parent_id')->nullable()->constrained('menu_items')->nullOnDelete();
      $table->foreignUlid('post_id')->nullable()->constrained('posts')->nullOnDelete();
      $table->timestamps();
    });

    Schema::create('comments', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignUlid('post_id')->constrained('posts')->cascadeOnDelete();
      $table->foreignUlid('user_id')->nullable()->constrained('users')->nullOnDelete();
      $table->string('author_name');
      $table->string('author_email');
      $table->text('content');
      $table->foreignUlid('parent_id')->nullable()->constrained('comments')->nullOnDelete();
      $table->enum('status', ['pending', 'approved', 'spam'])->default('pending');
      $table->timestamps();
    });

    Schema::create('library_post', function (Blueprint $table) {
      $table->ulid('id')->primary();
      $table->foreignUlid('library_id')->constrained('libraries')->cascadeOnDelete();
      $table->foreignUlid('post_id')->constrained('posts')->cascadeOnDelete();
      $table->enum('usage_type', ['featured', 'gallery', 'content'])->default('gallery');
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('library_post');
    Schema::dropIfExists('libraries');
    Schema::dropIfExists('comments');
    Schema::dropIfExists('menu_items');
    Schema::dropIfExists('menus');
    Schema::dropIfExists('post_tag');
    Schema::dropIfExists('post_category');
    Schema::dropIfExists('tags');
    Schema::dropIfExists('categories');
    Schema::dropIfExists('posts');
  }
};
