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
        Schema::create('tbl_assigned_subject', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('assigned_year_level');
            $table->unsignedBigInteger('assigned_strand'); 
            $table->foreign('assigned_strand')->references('id')->on('tbl_strand');
            $table->string('assigned_subject');
            $table->string('assigned_sem');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_assigned_subject');
    }
};
