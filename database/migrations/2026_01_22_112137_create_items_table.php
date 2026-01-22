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
        Schema::create('items', function (Blueprint $table) {
            Schema::create('items', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('item_code', 10)->unique();
                $table->string('item_name', 100)->unique();
                $table->enum('item_type', ['Consumable', 'Asset'])->index()->default('Consumable');
                $table->boolean('item_has_serial_no')->index()->default(false);
                $table->string('item_unit', 20)->nullable();
                $table->unsignedInteger('item_reorder_quantity')->nullable(true);
                $table->boolean('is_item_scrapable')->index()->default(true);
                $table->boolean('is_item_refundable')->index()->default(false);
                $table->enum('item_status', ['Active', 'Inactive'])->index()->default('Active');
                $table->timestamps();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
