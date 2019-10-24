<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('logo');
            $table->string('sitetitle');
            $table->string('siteemail');
            $table->text('sitekeyword');
            $table->string('facebookurl');
            $table->string('twitterurl');
            $table->string('googleplusurl');
            $table->string('linkedinurl');
            $table->string('phone');
            $table->string('mobile');
            $table->string('instagramurl');
            $table->string('fax');
            $table->string('address');
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
        Schema::dropIfExists('settings');
    }
}
