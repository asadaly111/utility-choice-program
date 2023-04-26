<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commercial_rates', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('supplier');
            $table->string('state');
            $table->string('commodity');
            $table->string('utility');
            $table->string('product');
            $table->string('demand_size');
            $table->string('start_month');
            $table->string('rate_class');
            $table->string('current_rate');
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commercial_rates');
    }
};
