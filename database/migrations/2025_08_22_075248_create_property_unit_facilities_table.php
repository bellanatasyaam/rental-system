<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('property_unit_facilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_unit_id');
            $table->unsignedBigInteger('facility_id');
            $table->json_decode('settings')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('property_unit_facilities');
    }
};
