<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSomeTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paper_user_favorites', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('paper_id');
            $table->index(['user_id', 'paper_id']);

//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
//            $table->foreign('paper_id')->references('id')->on('papers')->onDelete('cascade');

        });

        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('payment_id')->nullable()->unique();
            $table->integer('paper_id')->nullable();
            $table->double('amount', 14, 2);

            $table->timestamps();
            $table->softDeletes();
            $table->index('user_id');
            $table->index('paper_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->double('wallet', 14, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paper_user_favorites');
        Schema::dropIfExists('wallet_transactions');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('wallet');
        });

    }
}
