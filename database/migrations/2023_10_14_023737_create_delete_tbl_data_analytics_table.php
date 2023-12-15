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
        Schema::create('delete_tbl_data_analytics', function (Blueprint $table) {
            $table->id();
            $table->integer('evaluator_id');
            $table->string('evaluator_type');
            $table->integer('teacher_id'); 
            $table->integer('question_id'); 
            $table->integer('evaluation_score');
            $table->string('evaluation_remarks');
            $table->integer('evaluation_id'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delete_tbl_data_analytics');
    }
};
