<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Locaravel\Models\Identity\Address;
use Locaravel\Models\Type\AddressType;

class CreateFeaturesApartsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'hotels',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('code');

                $table->integer('address_id')->unsigned()->nullable()->default(null);
                $table->foreign('address_id')->references('id')->on('addresses')->onUpdate('cascade')->onDelete('set null');
                $table->timestamps();
            }
        );

        Schema::create(
            'aparts',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('code');
                $table->unsignedInteger('hotel_id');
                $table->timestamps();

                $table->foreign('hotel_id')->references('id')->on('hotels');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aparts');
        Schema::dropIfExists('hotels');
        Schema::dropIfExists('addresseables');
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('address_types');
    }
}
