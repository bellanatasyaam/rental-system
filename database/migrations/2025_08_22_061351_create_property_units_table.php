<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('property_units', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->string('unit_code');
            $table->string('name');
            $table->decimal('area', 10, 2)->nullable()->change();
            $table->decimal('monthly_price', 15, 2)->nullable()->change();
            $table->decimal('deposit_amount', 15, 2)->nullable()->change();
            $table->string('status')->default('available');
            $table->text('notes')->nullable();
            $table->timestamps();

            // foreign key buat ke tabel properties
            $table->foreign('property_id')
                  ->references('id')
                  ->on('properties')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('property_units');
    }
};