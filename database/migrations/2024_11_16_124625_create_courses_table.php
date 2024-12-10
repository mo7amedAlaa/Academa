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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('instructor_id')->constrained('instructors');
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->float('discount')->nullable();
            $table->integer('max_students')->nullable();
            $table->integer('duration_hours');
            $table->string('cover_image')->nullable();
            $table->date('start_date')->nullable();
            $table->string('status');
            $table->boolean('isFree')->nullable()->default(false);
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('level_id')->constrained('course_levels');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
};
