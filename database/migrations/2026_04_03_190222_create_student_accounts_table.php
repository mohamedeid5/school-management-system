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
        Schema::create('student_accounts', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('type');
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('fee_invoice_id')->nullable()->constrained('fee_invoices')->cascadeOnDelete();
            $table->foreignId('payment_student_id')->nullable()->constrained('payment_students')->cascadeOnDelete();
            $table->foreignId('receipt_student_id')->nullable()->constrained('receipt_students')->cascadeOnDelete();
            $table->foreignId('processing_fee_id')->nullable()->constrained('processing_fees')->cascadeOnDelete();
            $table->decimal('debit', 8, 2)->nullable()->default(0.00);
            $table->decimal('credit', 8, 2)->nullable()->default(0.00);
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_accounts');
    }
};
