<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            if (!Schema::hasColumn('tenants', 'name')) {
                $table->string('name')->after('id');
            }
            if (!Schema::hasColumn('tenants', 'contact_name')) {
                $table->string('contact_name')->nullable()->after('name');
            }
            if (!Schema::hasColumn('tenants', 'phone')) {
                $table->string('phone')->nullable()->after('contact_name');
            }
            if (!Schema::hasColumn('tenants', 'email')) {
                $table->string('email')->nullable()->after('phone');
            }
            if (!Schema::hasColumn('tenants', 'id_card_number')) {
                $table->string('id_card_number')->nullable()->after('email');
            }
            if (!Schema::hasColumn('tenants', 'address')) {
                $table->text('address')->nullable()->after('id_card_number');
            }
        });
    }

    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $cols = ['name','contact_name','phone','email','id_card_number','address'];
            foreach ($cols as $col) {
                if (Schema::hasColumn('tenants', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
