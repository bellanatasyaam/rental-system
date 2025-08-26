<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_unit_id');
            $table->unsignedBigInteger('tenant_id');
            $table->string('contract_number')->unique();
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('monthly_rent', 15, 2);
            $table->decimal('deposit_amount', 15, 2)->nullable();
            $table->string('payment_due_day')->default('1');
            $table->string('status')->default('active');
            $table->timestamps();

            $table->foreign('property_unit_id')->references('id')->on('property_units')->onDelete('cascade');
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('contracts');
    }
};
