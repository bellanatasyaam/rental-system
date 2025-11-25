<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up()
    {
        Schema::table('property_units', function (Blueprint $table) {
            $table->decimal('area', 10, 2)->nullable();
            $table->decimal('monthly_price', 10, 2)->nullable();
            $table->decimal('deposit_amount', 10, 2)->nullable();
        });
    }

    public function down()
    {
        Schema::table('property_units', function (Blueprint $table) {
            $table->dropColumn(['area', 'monthly_price', 'deposit_amount']);
        });
    }
};
