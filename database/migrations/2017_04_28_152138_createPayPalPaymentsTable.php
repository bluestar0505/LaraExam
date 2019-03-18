<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayPalPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paypal_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('paypal_id');
            $table->float('amount');
            $table->string('currency');
            $table->enum('state', ['created', 'canceled', 'paid', 'approved', 'failed'])->default('created');
            $table->timestamps();
            $table->softDeletes();
            $table->index('paypal_id', 'user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('paypal_payments');

    }
}
