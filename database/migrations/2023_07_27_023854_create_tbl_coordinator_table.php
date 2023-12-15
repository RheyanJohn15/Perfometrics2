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
        Schema::create('tbl_coordinator', function (Blueprint $table) {
            $table->id();
            $table->string('coordinator_username');
            $table->string('coordinator_password');
            $table->string('coordinator_first_name');
            $table->string('coordinator_middle_name');
            $table->string('coordinator_last_name');
            $table->string('coordinator_suffix');
            $table->string('coordinator_position');
            $table->integer('coordinator_image');
            $table->string('coordinator_image_type');
            $table->integer('coordinator_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_coordinator');
    }
};
