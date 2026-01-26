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
            $table->uuid('id')->primary()->comment('primary key');
            $table->string('item_code', 10)->unique()->comment('unique item code');
            $table->string('item_name', 100)->unique()->comment('unique item name');
            $table->enum('item_type', ['Consumable', 'Asset'])->index()->default('Consumable')->comment('checks whether an item is a consumable or an asset');
            $table->boolean('item_has_serial_no')->index()->default(false)->comment('checks whether an item has a serial no or not. normally an asset has serial no and consumables are not');
            $table->string('item_unit', 20)->nullable()->comment('defines unit of an item like pieces, dozens etc')->default('Pieces');
            $table->unsignedInteger('item_reorder_quantity')->nullable(true)->default(1)->comment('sets default new order quantity');
            $table->boolean('is_item_scrapable')->index()->default(true)->comment('sets whether an item is scrapable or not');
            $table->boolean('is_item_refundable')->index()->default(false)->comment('sets whether an item is refundable when an employee exits or not');
            $table->enum('item_status', ['Active', 'Inactive'])->index()->default('Active')->comment('checks whether we are currently dealing with this item or not');
            $table->timestamps();
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
