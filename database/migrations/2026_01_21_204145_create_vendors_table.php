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
            $table->uuid('id')->primary()->comment('primary key');
            $table->string('vendor_code', 10)->unique()->comment('unique vendor id');
            $table->string('vendor_name', 100)->unique()->comment('vendor name');
            $table->text('vendor_address')->nullable()->comment('non mandatory vendor address')->default('Siliguri');
            $table->string('vendor_city', 30)->index()->comment('city of vendor')->default('Siliguri');
            $table->string('vendor_state', 30)->index()->default('West Bengal')->comment('state of vendor');
            $table->string('vendor_pin', 6)->nullable()->default('734001')->comment('non mandatory pin of vendor');
            $table->string('vendor_mobile', 20)->nullable()->comment('non mandatory mobile no of vendor');
            $table->string('vendor_email', 50)->nullable()->comment('non mandatory email of vendor. preferably unique, but i kept it as it is');
            $table->string('vendor_gst_no', 15)->nullable()->unique()->comment('gst no of vendor');
            $table->enum('vendor_status', ['Active', 'Inactive'])->index()->default('Active')->comment('status of vendor - whether we are dealing with it or not');
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
