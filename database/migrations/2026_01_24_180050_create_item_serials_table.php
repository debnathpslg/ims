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
        Schema::create('item_serials', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('primary key');
            $table->foreignIdFor(\App\Models\Item::class, 'item_id')->constrained('items', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(\App\Models\Invoice::class, 'invoice_id')->constrained('invoices', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('serial_no', 128)->index()->nullable()->comment('optional item serial no, null for consumables but required for assets');
            $table->enum('status', ['Available', 'Issued', 'Scrapped', 'Refunded', 'Returned'])->index()->default('Available')->comment('item movement status');
            $table->enum('current_holder_type', ['Store', 'Employee', 'Purged'])->index()->default('Store')->comment('who holds the item at present, purged if returned, refunded or scrapped');
            $table->uuid('current_holder_id')->nullable()->comment('if current holter type is employee then employee id else null');
            $table->text('remarks')->nullable(true)->comment('space for special instruction or note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_serials');
    }
};
