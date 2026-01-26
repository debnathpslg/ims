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
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('primary key');
            $table->foreignIdFor(\App\Models\Item::class, 'item_id')->constrained('items', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(\App\Models\Invoice::class, 'invoice_id')->constrained('invoices', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedInteger('quantity')->default(0)->comment('nth item quantity in an invoice');
            $table->decimal('rate', 13, 2)->default(0.00)->comment('nth item rate in an invoice');
            $table->decimal('amount', 13, 2)->default(0.00)->comment('nth item amount in an invoice to be calculated as quantity times rate');
            $table->decimal('tax_percent', 5, 2)->default(0.00)->comment('nth item tax percentage in an invoice');
            $table->decimal('tax_amount', 13, 2)->default(0.00)->comment('nth item tax amount in an invoice to be calculated as amount times tax percent by 100');
            $table->decimal('item_amount', 13, 2)->default(0.00)->comment('nth item gross amount in an invoice to be calculated as amount plus tax amount');
            $table->timestamps();

            // $table->unique(['invoice_id', 'item_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_items');
    }
};
