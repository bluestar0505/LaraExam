<?php

use Illuminate\Database\Seeder;

class DomainsMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
            'position' => 100,
            'menu_type' => 1,
            'icon' => 'fa-envelope-o',
            'name' => 'Domains',
            'title' => 'Domain Names',
        ]);
    }
}
