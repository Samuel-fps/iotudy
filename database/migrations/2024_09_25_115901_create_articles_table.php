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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('slug', 255)->unique();
            $table->string('introduction', 255);
            $table->string('image', 255);
            $table->text('body');
            $table->boolean('status')->default(0);

            // Relation user
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('set null');
            
             // Relation category
             $table->unsignedBigInteger('category_id');
             $table->foreign('category_id')
                   ->references('id')->on('categories')
                   ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
