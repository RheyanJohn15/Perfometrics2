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
        Schema::create('tbl_admin', function (Blueprint $table) {
            $table->id();
            $table->string('admin_username');
            $table->string('admin_password');
            $table->string('admin_type');
            $table->string('admin_first_name');
            $table->string('admin_last_name');
            $table->string('admin_middle_name');
            $table->string('admin_suffix');
            $table->integer('admin_image');
            $table->string('admin_image_type');
            $table->string('admin_sem');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_admin');
    }
};
