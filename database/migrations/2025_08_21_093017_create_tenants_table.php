<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('id_card_number')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();
        });

        Schema::table('tenants', function (Blueprint $table) {
            $cols = ['name','contact_name','phone','email','id_card_number','address'];
            foreach ($cols as $col) {
                if (!Schema::hasColumn('tenant', $col)) {
                    $table->string($col)->nullable();
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('tenant', function (Blueprint $table) {
            $cols = ['name','contact_name','phone','email','id_card_number','address'];
            foreach ($cols as $col) {
                if (Schema::hasColumn('tenant', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
