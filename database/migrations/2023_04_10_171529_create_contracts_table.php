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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
$table->integer('user_id');
$table->integer('customer_id');
$table->integer('account_id');
$table->string('state');
$table->string('utility');
$table->string('account_number');
$table->string('ein')->nullable();
$table->string('commodity');
$table->string('supplier');
$table->string('product');
$table->string('start_month');
$table->string('rate_class');
$table->string('current_rate');
$table->string('volume');
$table->string('status')->default('Draft');
$table->string('flag')->nullable();

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
        Schema::dropIfExists('contracts');
    }
};
