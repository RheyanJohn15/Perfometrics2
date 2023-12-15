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
        Schema::create('tbl_room_available', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id'); 
            $table->foreign('room_id')->references('id')->on('tbl_room');
            $table->string('room_day');
            $table->string('7:30AM - 8:30AM');
            $table->string('8:30AM - 9:30AM');
            $table->string('9:45AM - 10:45AM');
            $table->string('10:45AM - 11:45AM');
            $table->string('1:00PM - 2:00PM');
            $table->string('2:00PM - 3:00PM');
            $table->string('3:00PM - 4:00PM');
            $table->string('4:00PM - 5:00PM');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_room_available');
    }
};
