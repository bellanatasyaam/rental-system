<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            if (!Schema::hasColumn('tenants', 'religion')) {
                $table->string('religion')->nullable();
            }
            if (!Schema::hasColumn('tenants', 'occupation')) {
                $table->string('occupation')->nullable();
            }
            if (!Schema::hasColumn('tenants', 'marital_status')) {
                $table->string('marital_status')->nullable();
            }
            if (!Schema::hasColumn('tenants', 'origin_address')) {
                $table->text('origin_address')->nullable();
            }
            if (!Schema::hasColumn('tenants', 'emergency_contact')) {
                $table->string('emergency_contact')->nullable();
            }
            if (!Schema::hasColumn('tenants', 'rental_start_date')) {
                $table->date('rental_start_date')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            foreach ([
                'religion', 'occupation', 'marital_status',
                'origin_address', 'emergency_contact', 'rental_start_date'
            ] as $col) {
                if (Schema::hasColumn('tenants', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
