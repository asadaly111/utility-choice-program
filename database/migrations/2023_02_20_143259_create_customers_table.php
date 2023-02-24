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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('document',255);
            $table->string('first_name',255);
            $table->string('last_name',255);
            $table->longText('phone',255);
            $table->string('title',255);
            $table->string('email',255);
            $table->string('business_name',255);
            $table->string('doing_business_as',255);
            $table->string('business_type',255);
            $table->string('ein',255);
            $table->string('industry',255);
            $table->string('address1',255);
            $table->string('address2',255)->nullable();
            $table->string('state',255);
            $table->string('city',255);
            $table->string('zip',255);
            $table->string('billing_address',255)->nullable();
            $table->string('billing_state',255)->nullable();
            $table->string('billing_city',255)->nullable();
            $table->string('billing_zip',255)->nullable();
            $table->boolean('tax_exempt')->default(false);
            $table->boolean('billing_address_option')->default(false);
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('customers');
    }
};
