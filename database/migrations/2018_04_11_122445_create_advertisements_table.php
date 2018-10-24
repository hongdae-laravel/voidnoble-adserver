<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->increments('id')->autoIncrement();
            $table->string('type', 50)->default("");
            $table->string('title', 255)->default("");
            $table->string('code', 50)->default("");
            $table->string('file', 200)->nullable()->default("");
            $table->string('position', 50)->default("");
            $table->unsignedTinyInteger('sequence')->unsigned()->default(1);
            $table->unsignedInteger('width')->default(0);
            $table->unsignedInteger('height')->default(0);
            $table->string('link', 200)->default("");
            $table->string('link_title', 255)->default("");
            $table->unsignedTinyInteger('link_new_window')->default(1);
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
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
        Schema::dropIfExists('advertisements');
    }
}
