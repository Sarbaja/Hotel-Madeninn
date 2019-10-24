<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_booking', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('room_id');
            $table->string('check_in_date');
            $table->string('check_out_date');
            $table->string('no_of_room');
            $table->string('total_price');
            $table->string('customer_name');
            $table->string('email');
            $table->string('contact');
            $table->string('city');
            $table->string('country');
            $table->string('card_name');
            $table->string('card_number');
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
        Schema::dropIfExists('tbl_booking');
    }
}
