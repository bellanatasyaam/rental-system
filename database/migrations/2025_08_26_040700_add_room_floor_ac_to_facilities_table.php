<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('facilities', function (Blueprint $table) {
            // tambahkan kolom baru
            $table->string('room')->nullable()->after('type');
            $table->string('floor')->nullable()->after('room');
            $table->enum('ac', ['AC', 'No AC'])->default('No AC')->after('floor');
        });
    }

    public function down(): void
    {
        Schema::table('facilities', function (Blueprint $table) {
            $table->dropColumn(['room', 'floor', 'ac']);
        });
    }
};
