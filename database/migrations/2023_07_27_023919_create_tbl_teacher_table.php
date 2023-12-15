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
        Schema::create('tbl_teacher', function (Blueprint $table) {
            $table->id();
            $table->string('teacher_username');
            $table->string('teacher_password');
            $table->string('teacher_first_name');
            $table->string('teacher_middle_name');
            $table->string('teacher_last_name');
            $table->string('teacher_suffix');
            $table->integer('teacher_image');
            $table->string('teacher_image_type');
            $table->integer('teacher_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_teacher');
    }
};
