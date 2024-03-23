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
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('language_id')->unsigned();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->string('faculty')->nullable();
            $table->string('semesters')->nullable();
            $table->string('credits')->nullable();
            $table->string('courses')->nullable();
            $table->string('duration')->nullable();
            $table->double('fee',10,2)->nullable();
            $table->longText('description')->nullable();
            $table->text('attach')->nullable();
            $table->boolean('status')->default('1');
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
        Schema::dropIfExists('courses');
    }
};
