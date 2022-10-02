<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title', 120);
            $table->integer('parent_id')->unsigned()->default(0);
            $table->string('description', 400)->nullable();
            $table->string('status', 60)->default('published');
            $table->tinyInteger('order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->unsignedBigInteger('created_id');
            $table->unsignedBigInteger('updated_id');
            $table->timestamps();
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('title', 120);
            $table->string('description', 400)->nullable()->default('');
            $table->string('status', 60)->default('published');
            $table->unsignedSmallInteger('created_id');
            $table->unsignedBigInteger('updated_id');
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('description', 400)->nullable();
            $table->longText('content')->nullable();
            $table->string('status', 60)->default('published');
            $table->tinyInteger('is_featured')->unsigned()->default(0);
            $table->string('thumbnail', 255)->nullable();
            $table->integer('views')->unsigned()->default(0);
            $table->unsignedBigInteger('created_id');
            $table->unsignedBigInteger('updated_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('post_tags', function (Blueprint $table) {
            $table->id();
            $table->integer('tag_id')->unsigned()->references('id')->on('tags')->onDelete('cascade');
            $table->integer('post_id')->unsigned()->references('id')->on('posts')->onDelete('cascade');
        });

        Schema::create('post_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->unsigned()->references('id')->on('categories')->onDelete('cascade');
            $table->integer('post_id')->unsigned()->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('post_tags');
        Schema::dropIfExists('post_categories');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('tags');
    }
}
