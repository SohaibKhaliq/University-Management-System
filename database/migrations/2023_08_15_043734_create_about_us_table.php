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
        Schema::create('about_us', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('language_id')->unsigned();
            $table->string('label')->nullable();
            $table->string('title')->nullable();
            $table->text('short_desc')->nullable();
            $table->longText('description')->nullable();
            $table->longText('features')->nullable();
            $table->text('attach')->nullable();
            $table->string('video_id')->nullable();
            $table->string('button_text')->nullable();
            $table->string('mission_title')->nullable();
            $table->text('mission_desc')->nullable();
            $table->string('mission_icon')->nullable();
            $table->text('mission_image')->nullable();
            $table->string('vision_title')->nullable();
            $table->text('vision_desc')->nullable();
            $table->string('vision_icon')->nullable();
            $table->text('vision_image')->nullable();
            $table->boolean('status')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
