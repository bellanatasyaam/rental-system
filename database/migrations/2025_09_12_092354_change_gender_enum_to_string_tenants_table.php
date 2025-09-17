<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Tambahkan kolom sementara untuk backup data gender
        Schema::table('tenants', function (Blueprint $table) {
            $table->string('gender_temp')->nullable()->after('name');
        });

        // Salin data gender ke kolom sementara
        DB::statement('UPDATE tenants SET gender_temp = gender');

        // Hapus kolom enum gender
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropColumn('gender');
        });

        // Tambahkan kolom gender baru dengan tipe string
        Schema::table('tenants', function (Blueprint $table) {
            $table->string('gender')->nullable()->after('name');
        });

        // Salin kembali data dari gender_temp ke gender
        DB::statement('UPDATE tenants SET gender = gender_temp');

        // Hapus kolom sementara gender_temp
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropColumn('gender_temp');
        });

        // Tambahkan kolom lain jika belum ada
        Schema::table('tenants', function (Blueprint $table) {
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
            if (!Schema::hasColumn('tenants', 'email')) {
                $table->string('email')->nullable()->after('emergency_contact');
            }
            if (!Schema::hasColumn('tenants', 'rental_start_date')) {
                $table->date('rental_start_date')->nullable()->after('email');
            }
            if (!Schema::hasColumn('tenants', 'id_card_number')) {
                $table->string('id_card_number')->nullable()->after('rental_start_date');
            }
            if (!Schema::hasColumn('tenants', 'address')) {
                $table->text('address')->nullable()->after('id_card_number');
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
                'email',
                'rental_start_date',
                'id_card_number',
                'address'
            ]);
        });

        // rollback untuk gender belum disediakan, bisa dikembangkan jika diperlukan
    }
};
