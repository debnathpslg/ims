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
        Schema::create('item_movements', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('primary key');
            $table->foreignIdFor(\App\Models\Item::class, 'item_id')->constrained('items', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->uuid('serial_id')->nullable()->comment('if item is an asset then serial id from item_serials else null');
            $table->unsignedInteger('quantity')->default(1)->comment('no of item moved, it is strictly one');
            $table->enum('source_of_movement', ['Invoice', 'Issue', 'Return', 'Scrap', 'Refund', 'Reversal'])->index()->default('Invoice')->comment('where it comes from or it goes');
            $table->uuid('source_of_movement_id')->nullable()->index()->comment('source of movent key - invoice_id or issue_id or null');
            $table->enum('where_it_comes_from_type', ['Store', 'Employee', 'Vendor', 'None'])->index()->default('Store')->comment('type of movement where the item comes from');
            $table->uuid('where_it_comes_from_id')->nullable()->comment('if it comes from an employee then employee_id, if vendor then vendor_id else null');
            $table->enum('where_it_moves_to_type', ['Store', 'Employee', 'Vendor', 'None'])->index()->default('Employee')->comment('type of movement where the item moves to');
            $table->uuid('where_it_moves_to_id')->nullable()->index()->comment('if it moves to an employee then employee_id, if vendor then vendor_id else null');
            $table->text('remarks')->nullable(true)->comment('space for special instruction or note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_movements');
    }
};
