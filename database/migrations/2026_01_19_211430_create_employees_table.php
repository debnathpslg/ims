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
            $table->uuid('id')->primary()->comment('primary key');
            $table->string('employee_code', 10)->unique()->comment('unique code for employee');
            $table->string('employee_name', 50)->index()->comment('employee name');
            $table->string('employee_designation', 20)->index()->comment('employee designation');
            $table->string('employee_email', 50)->unique()->comment('employee email and it is unique');
            $table->string('employee_mobile', 20)->index()->comment('employee mobile no, it should be uniquie but mobiles are swapped, hence it is kept as non unique');
            $table->enum('employee_status', ['Active', 'Inactive'])->index()->default('Active')->comment('employee status - flags whether an employee is commissioned or not');
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
