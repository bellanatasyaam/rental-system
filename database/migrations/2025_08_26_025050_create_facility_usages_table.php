<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('facility_usages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_unit_facility_id')->constrained()->onDelete('cascade');
            $table->foreignId('contract_id')->constrained()->onDelete('cascade');
            $table->date('period_start');
            $table->date('period_end');
            $table->decimal('usage_value', 10, 2);
            $table->decimal('rate', 10, 2);
            $table->decimal('total_cost', 10, 2);
            $table->boolean('invoiced')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('facility_usages');
    }
};
