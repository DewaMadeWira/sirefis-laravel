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
           if (!Schema::hasTable('gpu_data')) {
        Schema::create('gpu_data', function (Blueprint $table) {
            $table->id();
            $table->integer('gpu_id');
            $table->string('gpu_name',34);
            $table->string('G3Dmark',7);
            $table->string('G2Dmark',7);
            $table->string('price',6);
            $table->string('gpu_value',18);
            $table->string('TDP',4);
            $table->string('power_performance',18);
            $table->string('test_date',8);
            $table->string('category',19);
            // $table->timestamps();
        });
    }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gpu_data');
    }
};
