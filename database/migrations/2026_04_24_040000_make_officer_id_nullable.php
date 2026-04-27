<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['officer_id']);
            $table->foreignId('officer_id')->nullable()->change();
            $table->foreign('officer_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['officer_id']);
            $table->foreignId('officer_id')->constrained('users')->onDelete('cascade')->change();
        });
    }
};

