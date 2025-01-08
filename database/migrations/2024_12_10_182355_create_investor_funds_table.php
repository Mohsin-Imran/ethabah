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
        Schema::create('investor_funds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('name');
            $table->string('profit');
            $table->string('amount')->nullable();
            $table->string('month')->nullable();
            $table->string('total_funds')->nullable();
            $table->string('profit_percentage');
            $table->longText('duration_of_investment')->nullable();
            $table->string('start_of_period');
            $table->string('end_of_period');
            $table->longText('image')->nullable();
            $table->string('custom_months')->nullable();
            $table->string('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investor_funds');
    }
};