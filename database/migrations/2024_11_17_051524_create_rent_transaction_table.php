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
        Schema::create('rent_transaction', function (Blueprint $table) {
            $table->id();
            $table->string('customer');
            $table->string('car');
            $table->date('rent_date');
            $table->date('return_date');
            $table->timestamps();

            $table->foreign('customer')->references('driver_license_number')->on('customer');
            $table->foreign('car')->references('number_plate')->on('car');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rent_transaction');
    }
};
