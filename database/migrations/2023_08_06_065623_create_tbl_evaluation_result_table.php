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
        Schema::create('tbl_evaluation_result', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evaluator_id'); 
            $table->foreign('evaluator_id')->references('id')->on('tbl_student');
            $table->string('evaluator_type');
            $table->unsignedBigInteger('teacher_id'); 
            $table->foreign('teacher_id')->references('id')->on('tbl_teacher');
            $table->unsignedBigInteger('question_id'); 
            $table->foreign('question_id')->references('id')->on('tbl_question');
            $table->integer('evaluation_score');
            $table->string('evaluation_remarks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_evaluation_result');
    }
};
