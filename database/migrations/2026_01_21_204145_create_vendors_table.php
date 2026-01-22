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
        Schema::create('vendors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('vendor_code', 10)->unique();
            $table->string('vendor_name', 100)->unique();
            $table->text('vendor_address')->nullable();
            $table->string('vendor_city', 30)->index();
            $table->string('vendor_state', 30)->index();
            $table->string('vendor_pin', 6)->nullable();
            $table->string('vendor_mobile', 20)->nullable();
            $table->string('vendor_email', 50)->nullable();
            $table->string('vendor_gst_no', 15)->nullable()->unique();
            $table->enum('vendor_status', ['Active', 'Inactive'])->index()->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
