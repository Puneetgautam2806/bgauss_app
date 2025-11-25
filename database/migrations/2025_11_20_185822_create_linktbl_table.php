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
        Schema::create('linktbl', function (Blueprint $table) {
            $table->id();
            $table->string('menu_name');
            $table->string('path')->nullable();
            $table->boolean('is_parent')->default(false);
            $table->string('icon')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('display')->default(true);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->timestamps();
            
            $table->foreign('parent_id')->references('id')->on('linktbl')->onDelete('cascade');
            $table->index(['parent_id', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('linktbl');
    }
};
