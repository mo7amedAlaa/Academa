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
        Schema::create('instructors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('phone')->nullable();
            $table->text('bio')->nullable();
            $table->string('nationality')->nullable();
            $table->integer('experience_years')->nullable();
            $table->string('experience_card');
            $table->integer('age')->nullable();
            $table->integer('ssn');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('instructors');
    }
};
