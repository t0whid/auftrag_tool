<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->longText('description');

            $table->string('location')->nullable();
            $table->string('team_info')->nullable();

            $table->date('start_date');
            $table->date('end_date');

            $table->decimal('hourly_rate', 10, 2)->nullable();
            $table->decimal('travel_cost', 10, 2)->nullable();
            $table->string('travel_cost_unit')->nullable()->default('km');
            $table->decimal('meal_allowance', 10, 2)->nullable();

            $table->string('custom_field_1_label')->nullable();
            $table->string('custom_field_1_value')->nullable();

            $table->string('custom_field_2_label')->nullable();
            $table->string('custom_field_2_value')->nullable();

            $table->boolean('is_active')->default(false);

            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};