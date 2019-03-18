<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQAtables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('discussionforum');
        Schema::dropIfExists('answers');

        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('paper_id');
            $table->text('question');
            $table->string('title');
            $table->integer('points')->default(0);
            $table->timestamps();

//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
//            $table->foreign('paper_id')->references('id')->on('papers')->onDelete('cascade');

        });
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('question_id')->nullable();
            $table->integer('parent_answer_id')->nullable();
            $table->text('answer');
            $table->integer('points')->default(0);
            $table->timestamps();

//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
//            $table->foreign('paper_id')->references('id')->on('papers')->onDelete('cascade');

        });

        Schema::create('votes', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->biginteger('voteable_id')->unsigned()->index();
            $table->string('voteable_type');
            $table->biginteger('user_id')->unsigned()->index();
            $table->string('status');
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['user_id', 'voteable_id', 'voteable_type']);
//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votes');
        Schema::dropIfExists('answers');
        Schema::dropIfExists('questions');
        DB::statement('create table answers
            (
                ID int auto_increment
                    primary key,
                AnswerTxt text null,
                UserID int null,
                DateCreated timestamp null on update CURRENT_TIMESTAMP,
                QuestionNo int null
            )
            engine=InnoDB charset=latin1
            ;
            
            ');
        DB::statement('create table discussionforum
            (
                ID int auto_increment
                    primary key,
                QuestionTxt text null,
                DateCreated timestamp null on update CURRENT_TIMESTAMP,
                UserID int null,
                CategoryID int null,
                PaperID int null,
                QuestionNo int null
            )
            engine=InnoDB charset=latin1
            ;
            
            ');

    }
}
