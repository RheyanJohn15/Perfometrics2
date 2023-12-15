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
        Schema::create('tbl_section', function (Blueprint $table) {
            $table->id();
            $table->string('section');
            $table->unsignedBigInteger('strand_id'); 
            $table->foreign('strand_id')->references('id')->on('tbl_strand');
            $table->string('year_level');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_section');
    }
};
