<?php

use Locaravel\Models\Identity\Address;
use Locaravel\Models\Type\AddressType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeaturesRotasTables extends Migration
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
            'trip_types', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255);
                $table->string('type', 255);
                $table->timestamps();
                $table->softDeletes();
            }
        );
        Schema::create(
            'trips', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->integer('trip_type_id')->nullable();
                $table->integer('category_id')->nullable();
                $table->string('content', 255)->nullable();
                $table->string('description', 255)->nullable();
                $table->string('observation', 255)->nullable();

                $table->integer('trip_id')->unsigned()->nullable()->default(null);
                $table->foreign('trip_id')->references('id')->on('trips')->onUpdate('cascade')->onDelete('set null');

                $table->timestamps();
                $table->softDeletes();
            }
        );
        
        Schema::create(
            'tripables', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->integer('trip_id')->unsigned();
                $table->foreign('trip_id')->references('id')->on('trips');

                $table->string('tripeable_id')->nullable();
                $table->string('tripeable_type', 255)->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );
        


        Schema::create(
            'passages', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('code');

                $table->integer('trip_init_id')->unsigned()->nullable()->default(null);
                $table->foreign('trip_init_id')->references('id')->on('trips')->onUpdate('cascade')->onDelete('set null');

                $table->integer('trip_end_id')->unsigned()->nullable()->default(null);
                $table->foreign('trip_end_id')->references('id')->on('trips')->onUpdate('cascade')->onDelete('set null');

                $table->timestamps();
            }
        );

        
        Schema::create(
            'passageables', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->integer('passage_id')->unsigned();
                $table->foreign('passage_id')->references('id')->on('passages');

                $table->string('passageable_id')->nullable();
                $table->string('passageable_type', 255)->nullable();
                $table->timestamps();
                $table->softDeletes();
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
        Schema::dropIfExists('passageables');
        Schema::dropIfExists('passages');
        Schema::dropIfExists('tripables');
        Schema::dropIfExists('trips');
        Schema::dropIfExists('trip_types');
    }
}
