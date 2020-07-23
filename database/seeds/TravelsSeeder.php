<?php

use Illuminate\Database\Seeder;

class TravelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(Locaravel\Models\Travels\Hotel::class, 2)->create()->each(function($hotel) {
            $hotel->aparts()->save(factory(Locaravel\Models\Travels\Apart::class, rand(1, 100))->create()->each(function($room) {
                // $room->travels()->save(factory(Locaravel\Models\Travels\Travel::class, rand(1, 100))->make());  @todo 
                return true;
            }));
        });
    }
}
