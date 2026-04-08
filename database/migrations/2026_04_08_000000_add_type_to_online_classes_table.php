<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('online_classes', function (Blueprint $table) {
            $table->enum('type', ['zoom', 'manual'])->default('zoom')->after('title');
        });
    }

    public function down(): void
    {
        Schema::table('online_classes', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
