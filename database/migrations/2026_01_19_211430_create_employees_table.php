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
        Schema::create('employees', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('employee_code', 10)->unique();
            $table->string('employee_name', 50)->index();
            $table->string('employee_designation', 20)->index();
            $table->string('employee_email', 50)->unique();
            $table->string('employee_mobile', 20)->index();
            $table->enum('employee_status', ['Active', 'Inactive'])->index()->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
