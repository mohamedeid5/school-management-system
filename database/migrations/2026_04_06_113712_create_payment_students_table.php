<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_students', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->decimal('amount', 8, 2);
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_students');
    }
};
