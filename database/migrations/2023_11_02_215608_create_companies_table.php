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
        if (!Schema::hasTable('company')) {
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->string('company_name',30);
            $table->string('ceo',10);
            $table->string('location',200);
            // $table->timestamps();
        });
    }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company');
    }
};
