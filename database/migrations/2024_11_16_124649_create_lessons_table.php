<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->references('id')->on('courses')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('instructor_id')->nullable()->references('id')->on('instructors')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('title');
            $table->enum('content_type', ['video', 'image', 'link', 'quiz', 'practice']);
            $table->string('media')->nullable();
            $table->string('link')->nullable();
            $table->unsignedInteger('position')->nullable();
            $table->boolean('is_public')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lessons');
    }
};
