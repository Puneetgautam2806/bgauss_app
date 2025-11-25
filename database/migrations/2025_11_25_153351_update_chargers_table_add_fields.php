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
        Schema::table('chargers', function (Blueprint $table) {

            $table->date('inward_date')->nullable();
            $table->string('part_serial_no')->nullable();
            $table->string('inward_lr_no')->nullable();

            $table->string('dealer_name')->nullable();
            $table->string('dealer_code')->nullable();

            $table->string('part_name')->nullable();
            $table->string('part_code')->nullable();

            $table->string('vin_number')->nullable();
            $table->date('sales_date')->nullable();

            $table->string('warranty_remark')->nullable();
            $table->text('problem_remark')->nullable();

            // simple string fields
            $table->string('status')->nullable();
            $table->string('device_status')->nullable();

            // extra fields
            $table->string('child_parts_used')->nullable(); // comma separated
            $table->text('resolution_remark')->nullable();
            $table->date('dispatch_date')->nullable();
            $table->string('dispatch_lr_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chargers', function (Blueprint $table) {

            $table->dropColumn([
                'inward_date',
                'part_serial_no',
                'inward_lr_no',
                'dealer_name',
                'dealer_code',
                'part_name',
                'part_code',
                'vin_number',
                'sales_date',
                'warranty_remark',
                'problem_remark',
                'status',
                'device_status',
                'child_parts_used',
                'resolution_remark',
                'dispatch_date',
                'dispatch_lr_no',
            ]);
        });
    }
};
