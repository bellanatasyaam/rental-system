<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            // Tambah kolom baru
            if (!Schema::hasColumn('tenants', 'religion')) {
                $table->string('religion')->nullable()->after('gender');
            }
            if (!Schema::hasColumn('tenants', 'occupation')) {
                $table->string('occupation')->nullable()->after('religion');
            }
            if (!Schema::hasColumn('tenants', 'marital_status')) {
                $table->string('marital_status')->nullable()->after('occupation');
            }
            if (!Schema::hasColumn('tenants', 'origin_address')) {
                $table->string('origin_address')->nullable()->after('marital_status');
            }
            if (!Schema::hasColumn('tenants', 'phone')) {
                $table->string('phone')->nullable()->after('origin_address');
            }
            if (!Schema::hasColumn('tenants', 'emergency_contact')) {
                $table->string('emergency_contact')->nullable()->after('phone');
            }
            if (!Schema::hasColumn('tenants', 'rental_start_date')) {
                $table->date('rental_start_date')->nullable()->after('emergency_contact');
            }
            if (!Schema::hasColumn('tenants', 'id_card_number')) {
                $table->string('id_card_number')->nullable()->after('rental_start_date');
            }
        });
    }

    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropColumn([
                'religion',
                'occupation',
                'marital_status',
                'origin_address',
                'phone',
                'emergency_contact',
                'rental_start_date',
                'id_card_number'
            ]);
        });
    }
};
