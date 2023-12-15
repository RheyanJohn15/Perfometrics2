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
        Schema::create('tbl_student', function (Blueprint $table) {
            $table->id();
            $table->string('student_id');
            $table->string('student_password');
            $table->string('student_first_name');
            $table->string('student_last_name');
            $table->string('student_middle_name');
            $table->string('student_suffix');
            $table->string('student_year_level');
            $table->unsignedBigInteger('student_strand'); 
            $table->foreign('student_strand')->references('id')->on('tbl_strand');
            $table->unsignedBigInteger('student_section'); 
            $table->foreign('student_section')->references('id')->on('tbl_section');
            $table->string('student_mail');
            $table->integer('student_image');
            $table->string('student_image_type');
            $table->integer('student_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_student');
    }
};
