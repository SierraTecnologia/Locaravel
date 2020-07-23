<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create(
            'localizations', function (Blueprint $table) {
                $table->increments('id');
                $table->double('latitude');
                $table->double('longitude');
                $table->integer('localizationable_id')->unsigned();
                $table->string('localizationable_type');
            }
        );
        // Note: Laravel does not support spatial types.
        // See: https://dev.mysql.com/doc/refman/5.7/en/spatial-type-overview.html
        if (config('database.default') == 'mysql') {
            DB::statement("ALTER TABLE `localizations` ADD `coordinates` POINT;");
        }
        Schema::create(
            'localization_historys', function (Blueprint $table) {
                $table->increments('id');
                $table->double('latitude');
                $table->double('longitude');
                $table->integer('localization_id')->unsigned();
                $table->foreign('localization_id')->references('id')->on('localizations')->onDelete('cascade');
            }
        );

        // Note: Laravel does not support spatial types.
        // See: https://dev.mysql.com/doc/refman/5.7/en/spatial-type-overview.html
        if (config('database.default') == 'mysql') {
            DB::statement("ALTER TABLE `localization_historys` ADD `coordinates` POINT;");
        }

        /**
         * http://www.plumislandmedia.net/mysql/stored-function-haversine-distance-computation/
         * SELECT zip, primary_city, latitude, longitude,
        * 111.045*haversine(latitude,longitude,latpoint, longpoint) AS distance_in_km
*         FROM zip
  *           JOIN (
      *           SELECT  42.81  AS latpoint,  -70.81 AS longpoint
      *       ) AS p
       *      ORDER BY distance_in_km
       *      LIMIT 15
         */
        // DB::statement("DELIMITER $$
        // DROP FUNCTION IF EXISTS haversine$$
         
        // CREATE FUNCTION haversine(
        //         lat1 FLOAT, lon1 FLOAT,
        //         lat2 FLOAT, lon2 FLOAT
        //      ) RETURNS FLOAT
        //     NO SQL DETERMINISTIC
        //     COMMENT 'Returns the distance in degrees on the Earth
        //              between two known points of latitude and longitude'
        // BEGIN
        //     RETURN DEGREES(ACOS(
        //               COS(RADIANS(lat1)) *
        //               COS(RADIANS(lat2)) *
        //               COS(RADIANS(lon2) - RADIANS(lon1)) +
        //               SIN(RADIANS(lat1)) * SIN(RADIANS(lat2))
        //             ));
        // END$$
         
        // DELIMITER ;");
        // DB::statement("DELIMITER $$
        // DROP FUNCTION IF EXISTS haversinePt$$
         
        // CREATE FUNCTION haversinePt(
        //         point1 GEOMETRY,
        //         lat2 FLOAT, lon2 FLOAT
        //      ) RETURNS FLOAT
        //     NO SQL DETERMINISTIC
        //     COMMENT 'Returns the distance in degrees on the Earth
        //              between two known points of latitude and longitude
        //              where the first point is a geospatial object and
        //              the second is lat/long'
        // BEGIN
        //     RETURN DEGREES(ACOS(
        //               COS(RADIANS(X(point1))) *
        //               COS(RADIANS(lat2)) *
        //               COS(RADIANS(lon2) - RADIANS(Y(point1))) +
        //               SIN(RADIANS(X(point1))) * SIN(RADIANS(lat2))
        //             ));
        // END$$
         
        // DELIMITER ;");




    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('localization_historys');
        Schema::dropIfExists('localizations');
    }

}
