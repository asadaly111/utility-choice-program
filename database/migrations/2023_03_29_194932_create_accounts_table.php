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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('status', 255);
            $table->string('sub_type', 255);
            $table->string('commodity', 255);
            $table->string('zone', 255);
            $table->string('utility', 255);
            $table->string('current_rate', 255);
            $table->string('rate_class', 255);
            $table->string('contract_end_date', 255);
            $table->string('account_number', 255);
            $table->string('annual_volume', 255);
            $table->string('city', 255);
            $table->string('state', 255);
            $table->string('zip', 255);
            $table->string('address1', 255);
            $table->string('address2', 255)->nullable();
            $table->string('document', 255)->nullable();
            $table->string('bill', 255)->nullable();
            $table->string('loa', 255)->nullable();
            $table->string('lor', 255)->nullable();
            $table->string('misc', 255)->nullable();
            $table->string('tax_exempt', 255)->nullable();
            $table->string('notes', 255)->nullable();
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
        Schema::dropIfExists('accounts');
    }
};
