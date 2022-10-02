<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('description', 255);
            $table->string('mailable');
            $table->text('subject')->nullable();
            $table->longtext('html_template');
            $table->longtext('text_template')->nullable();
            $table->string('status', 60)->default('published');
            $table->boolean('is_footer')->default(true);
            $table->boolean('is_header')->default(true);
            $table->json('fields')->nullable();
            $table->unsignedBigInteger('created_id');
            $table->unsignedBigInteger('updated_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mail_templates');
    }
};
