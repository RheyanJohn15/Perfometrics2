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
        Schema::create('delete_tbl_student', function (Blueprint $table) {
            $table->id();
            $table->string('student_id');
            $table->string('student_password');
            $table->string('student_first_name');
            $table->string('student_last_name');
            $table->string('student_middle_name');
            $table->string('student_suffix');
            $table->string('student_year_level');
            $table->integer('student_strand'); 
            $table->integer('student_section'); 
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
        Schema::dropIfExists('delete_tbl_student');
    }
};
