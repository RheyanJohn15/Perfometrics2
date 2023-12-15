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
        Schema::create('tbl_assigned_teacher', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teacher_id'); 
            $table->foreign('teacher_id')->references('id')->on('tbl_teacher');
            $table->unsignedBigInteger('subject_id'); 
            $table->foreign('subject_id')->references('id')->on('tbl_assigned_subject');
            $table->string('grade_level');
            $table->unsignedBigInteger('section_id'); 
            $table->foreign('section_id')->references('id')->on('tbl_section');
            $table->string('sem');
            $table->unsignedBigInteger('strand_id'); 
            $table->foreign('strand_id')->references('id')->on('tbl_strand');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_assigned_teacher');
    }
};
