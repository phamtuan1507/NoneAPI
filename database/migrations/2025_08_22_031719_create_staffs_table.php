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
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->string('name');                  // Tên
            $table->string('position');              // Chức vụ
            $table->text('description')->nullable(); // Mô tả (text dài)
            $table->string('image')->nullable();     // Đường dẫn hình ảnh
            $table->integer('exp')->default(0);      // Kinh nghiệm (số năm, ví dụ)
            $table->string('phone')->nullable();     // Số điện thoại
            $table->string('email')->unique();       // Email (unique để tránh trùng)
            $table->string('facebook')->nullable();  // Link Facebook
            $table->string('twitter')->nullable();   // Link Twitter (hoặc X)
            $table->string('instagram')->nullable(); // Link Instagram
            $table->string('linkedin')->nullable();  // Link LinkedIn
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffs');
    }
};
