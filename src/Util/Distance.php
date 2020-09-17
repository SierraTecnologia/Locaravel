<?php

namespace App\Processing;

use UnitConverter\UnitConverter;

class Distance
{
    public static function distanceCalculation($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'km', $decimals = 2)
    {
        // Calculate the distance in degrees
        $degrees = rad2deg(acos((sin(deg2rad($point1_lat))*sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat))*cos(deg2rad($point2_lat))*cos(deg2rad($point1_long-$point2_long)))));
     
        // Convert the distance in degrees to the chosen unit (kilometres, miles or nautical miles)
        switch ($unit) {
        case 'km':
            $distance = $degrees * 111.13384; // 1 degree = 111.13384 km, based on the average diameter of the Earth (12,735 km)
            break;
        case 'mi':
            $distance = $degrees * 69.05482; // 1 degree = 69.05482 miles, based on the average diameter of the Earth (7,913.1 miles)
            break;
        case 'nmi':
            $distance =  $degrees * 59.97662; // 1 degree = 59.97662 nautic miles, based on the average diameter of the Earth (6,876.3 nautical miles)
        }
        return round($distance, $decimals);
    }

    /**
     * @var int
     */
    protected static $earth_radius = 6371000;

    /**
     * @param float $fromLatitude
     * @param float $fromLongitude
     * @param float $toLatitude
     * @param float $toLongitude
     * @param string $unit
     *
     * @return float
     */
    public static function calculate(
        float $fromLatitude,
        float $fromLongitude,
        float $toLatitude,
        float $toLongitude,
        string $unit = 'km'
    ): float {
        $latitudeRadian = deg2rad($toLatitude - $fromLatitude);
        $longitudeRadian = deg2rad($toLongitude - $fromLongitude);

        $a = sin($latitudeRadian / 2)
            * sin($latitudeRadian / 2)
            + cos(deg2rad($fromLatitude))
            * cos(deg2rad($toLatitude))
            * sin($longitudeRadian / 2)
            * sin($longitudeRadian / 2);

        return static::converter(
            static::$earth_radius * (2 * asin(sqrt($a))),
            $unit
        );
    }

    /**
     * @param float $distance
     * @param string $unit
     *
     * @return float
     */
    protected static function converter(float $distance, string $unit): float
    {
        return (float) (UnitConverter::default())
            ->convert($distance)
            ->from('m')
            ->to($unit);
    }
}
