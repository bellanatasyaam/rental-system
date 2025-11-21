<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('facilities', function (Blueprint $table) {
            if (!Schema::hasColumn('facilities', 'room')) {
                $table->string('room')->nullable()->after('type');
            }
            if (!Schema::hasColumn('facilities', 'floor')) {
                $table->string('floor')->nullable()->after('room');
            }
            if (!Schema::hasColumn('facilities', 'ac')) {
                $table->enum('ac', ['AC', 'No AC'])->default('No AC')->after('floor');
            }
        });
    }

    public function down(): void
    {
        Schema::table('facilities', function (Blueprint $table) {
            $table->dropColumn(['room', 'floor', 'ac']);
        });
    }
};
