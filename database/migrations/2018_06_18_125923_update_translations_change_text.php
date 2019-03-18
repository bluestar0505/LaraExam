<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTranslationsChangeText extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::table('translations')
                ->where('slug', 'text-changes-saved')
                ->update([ "text" => "Your changes have been saved"]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::table('translations')
                ->where('slug', 'text-changes-saved')
                ->update([ "text" => "Changes have been saved."]);
    }

}
