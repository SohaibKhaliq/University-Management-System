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
        Schema::create('topbar_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address_title')->nullable();
            $table->text('address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('working_hour')->nullable();
            $table->string('about_title')->nullable();
            $table->text('about_summery')->nullable();
            $table->string('social_title')->nullable();
            $table->boolean('social_status')->default('1');
            $table->boolean('status')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topbar_settings');
    }
};
