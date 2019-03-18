<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaperLikings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paper_likings', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('paper_id')->unsigned();
            // 0 for dislike, 1 for like
            $table->tinyInteger('choice')->unsigned()->default(1);
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
        Schema::drop('user_paper_lastviewed');
    }
}
