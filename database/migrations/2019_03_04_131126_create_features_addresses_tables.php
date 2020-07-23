<?php

use Locaravel\Models\Identity\Address;
use Locaravel\Models\Type\AddressType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturesAddressesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Ruas
         */
        Schema::create(
            'address_types', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255);
                $table->string('type', 255);
                $table->timestamps();
                $table->softDeletes();
            }
        );
        Schema::create(
            'addresses', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                
                $table->integer('address_type_id')->unsigned()->nullable()->default(null);
                $table->foreign('address_type_id')->references('id')->on('address_types')->onUpdate('cascade')->onDelete('set null');

                $table->integer('category_id')->unsigned()->nullable();
                $table->string('content', 255)->nullable();
                $table->string('description', 255)->nullable();
                $table->string('observation', 255)->nullable();

                $table->integer('address_id')->unsigned()->nullable()->default(null);
                $table->foreign('address_id')->references('id')->on('addresses')->onUpdate('cascade')->onDelete('set null');

                $table->timestamps();
                $table->softDeletes();
            }
        );
        
        Schema::create(
            'addresseables', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->integer('address_id')->unsigned();
                $table->string('addresseable_id')->nullable();
                $table->string('addresseable_type', 255)->nullable();
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('address_id')->references('id')->on('addresses');
            }
        );
        


        Schema::create(
            'hotels', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('code');

                $table->integer('address_id')->unsigned()->nullable()->default(null);
                $table->foreign('address_id')->references('id')->on('addresses')->onUpdate('cascade')->onDelete('set null');
                $table->timestamps();
            }
        );

        Schema::create(
            'aparts', function (Blueprint $table) {
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
