<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->foreignId('faculty_id')->constrained()->restrictOnDelete();
            $table->foreignId('group_id')->constrained()->restrictOnDelete();
            $table->string('specialty');
            $table->unsignedTinyInteger('course_year');
            $table->string('student_id_card_number', 50)->unique();
            $table->timestamps();
            $table->index(['faculty_id', 'course_year']);
        });
    }
    public function down(): void { Schema::dropIfExists('students'); }
};
