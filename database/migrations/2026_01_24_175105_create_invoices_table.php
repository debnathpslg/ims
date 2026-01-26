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
        Schema::create('invoices', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('primary key');
            $table->foreignIdFor(\App\Models\Vendor::class, 'vendor_id')->constrained('vendors', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('invoice_no', 30)->comment('invoice or bill no');
            $table->date('invoice_date')->index()->comment('date of invoice');
            $table->decimal('total_amount', 13, 2)->comment('total amount of all items excluding tax')->default(0.00);
            $table->decimal('total_tax', 13, 2)->default(0.00)->comment('total tax on all items');
            $table->decimal('gross_amount', 13, 2)->default(0.00)->comment('total amount plus total tax');
            $table->decimal('round_off', 13, 2)->default(0.00)->comment('rounding off value to make gross amount to nearest integer');
            $table->decimal('invoice_amount', 13, 2)->default(0.00)->comment('gross amount plus minus round off');
            $table->enum('status', ['Pending', 'Paid'])->index()->default('Pending')->comment('sets invoice payment status');
            $table->date('payment_date')->nullable(true)->index()->comment('date of payment, will be null if status is pending');
            $table->text('remarks')->nullable(true)->comment('space for special instruction or note');
            $table->timestamps();

            // Composite unique key: same invoice_no allowed across different vendors
            $table->unique(['vendor_id', 'invoice_no']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
