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
        Schema::table('tenants', function (Blueprint $table) {
            $table->string('gender')->nullable();
            $table->string('religion')->nullable();
            $table->string('occupation')->nullable();
            $table->string('marital_status')->nullable();
            $table->text('origin_address')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->date('rental_start_date')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropColumn([
                'gender', 'religion', 'occupation', 'marital_status',
                'origin_address', 'emergency_contact', 'rental_start_date'
            ]);
        });
    }
};
