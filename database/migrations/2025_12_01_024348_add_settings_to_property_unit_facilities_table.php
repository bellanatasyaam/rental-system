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
        Schema::table('property_unit_facilities', function (Blueprint $table) {
            $table->text('settings')->nullable()->after('facility_id');
        });
    }

    public function down()
    {
        Schema::table('property_unit_facilities', function (Blueprint $table) {
            $table->dropColumn('settings');
        });
    }
};
