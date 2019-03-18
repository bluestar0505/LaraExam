<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateDomainsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('domains',function(Blueprint $table){
            $table->increments("id");
            $table->string("domain");
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('domains')->insert(
            ['domain' => 'tcd.ie']
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('domains');
    }

}