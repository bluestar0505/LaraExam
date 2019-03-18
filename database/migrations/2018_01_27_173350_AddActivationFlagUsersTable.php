<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActivationFlagUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('email_verified')->default(false);
        });
        Schema::create('user_activations', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->string('token')->index();
            $table->timestamp('created_at')->nullable();
        });

        DB::update('update users set email_verified = true');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_activations');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('active');
        });
    }
}
