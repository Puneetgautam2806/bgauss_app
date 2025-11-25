<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // Already exist: email, password, name → skip if present
            if (!Schema::hasColumn('users', 'repair_type')) {
                $table->string('repair_type')->nullable()->after('name');
            }

            if (!Schema::hasColumn('users', 'location')) {
                $table->string('location')->nullable()->after('repair_type');
            }

            if (!Schema::hasColumn('users', 'city')) {
                $table->string('city')->nullable()->after('location');
            }

            if (!Schema::hasColumn('users', 'state')) {
                $table->string('state')->nullable()->after('city');
            }

            if (!Schema::hasColumn('users', 'usertype')) {
                $table->enum('usertype', ['admin', 'vendor', 'customer'])->default('customer')->after('state');
            }

            if (!Schema::hasColumn('users', 'status')) {
                $table->boolean('status')->default(1)->after('usertype'); // 1=active, 0=inactive
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'repair_type',
                'location',
                'city',
                'state',
                'usertype',
                'status'
            ]);
        });
    }
};
