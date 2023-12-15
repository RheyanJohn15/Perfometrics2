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
        Schema::create('tbl_class_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('sched_day');
            $table->string('sched_time');
            $table->unsignedBigInteger('sched_room'); 
            $table->foreign('sched_room')->references('id')->on('tbl_room');
            $table->unsignedBigInteger('sched_teacher'); 
            $table->foreign('sched_teacher')->references('id')->on('tbl_teacher');
            $table->unsignedBigInteger('sched_subject'); 
            $table->foreign('sched_subject')->references('id')->on('tbl_assigned_subject');
            $table->string('sched_class_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_class_schedules');
    }
};
