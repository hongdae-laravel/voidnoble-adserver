<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHtmlAndUrlToAdvertisements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("advertisements", function ($table) {
            $table->text('html')->nullable();
            $table->string('url', 200)->default("");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("advertisements", function ($table) {
            $table->dropColumn('html');
            $table->dropColumn('url');
        });
    }
}
