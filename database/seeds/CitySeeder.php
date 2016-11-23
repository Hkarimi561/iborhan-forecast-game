<?php

use Illuminate\Database\Seeder;
use App\Models\City;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city_json = File::get(storage_path() . "/json/city.json");
        $cities = json_decode($city_json);
        foreach($cities as $cityid=>$city){
            City::create([
                'name'=> $city->name ,
                'longitude'=> $city->longitude,
                'latitude'=> $city->latitude
            ]);
        }
    }
}
