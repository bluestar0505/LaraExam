<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMenusTableWithDomains extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $domainsMenuId = DB::table('menus')->insertGetId([
            'position' => 100,
            'menu_type' => 1,
            'icon' => 'fa-envelope-o',
            'name' => 'Domains',
            'title' => 'Domain Names',
        ]);

        DB::table('menu_role')->insert([
            'menu_id' => $domainsMenuId,
            'role_id' => 0,
        ]);

        DB::table('menu_role')->insert([
            'menu_id' => $domainsMenuId,
            'role_id' => 1,
        ]);

        DB::table('menu_role')->insert([
            'menu_id' => $domainsMenuId,
            'role_id' => 3,
        ]);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
