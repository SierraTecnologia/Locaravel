<?php
/**
 * Repete em Informate
 */
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacesTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        
        Schema::create(
            'places', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name');
                $table->timestamps();
                $table->softDeletes();
            }
        );
        
        Schema::create(
            'placeables', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('placeable_id');
                $table->string('placeable_type', 255);

                $table->unsignedInteger('place_id')->nullable();
                // $table->foreign('place_id')->references('id')->on('places');
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
        Schema::dropIfExists('placeables');
        Schema::dropIfExists('places');
    }

}
