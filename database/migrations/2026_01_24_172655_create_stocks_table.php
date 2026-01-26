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
        Schema::create('stocks', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('primary key');
            $table->foreignIdFor(\App\Models\Item::class, 'item_id')->constrained('items', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedInteger('total_purchased')->default(0)->comment('life time purchase quantity');
            $table->unsignedInteger('total_issued')->default(0)->comment('life time issue quantity');
            $table->unsignedInteger('total_scrapped')->default(0)->comment('life time scrapped quantity');
            $table->unsignedInteger('total_returned_by_employee')->default(0)->comment('life time received from employee quantity');
            $table->unsignedInteger('total_returned_to_vendor')->default(0)->comment('life time dispute item returned to vendor quantity');
            $table->unsignedInteger('stock_in_hand')->default(0)->comment('stock in hand at present');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
