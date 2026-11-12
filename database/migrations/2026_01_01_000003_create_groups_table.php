<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->foreignId('faculty_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('course_number');
            $table->timestamps();
            $table->unique(['faculty_id', 'name']);
        });
    }
    public function down(): void { Schema::dropIfExists('groups'); }
};
