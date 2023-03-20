<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GovSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $remote = isset($_SERVER["REMOTE_ADDR"]) ?? false;
        $url = 'database/seeders/json/cities.json' ;
        
        $citiesJson =  json_decode(file_get_contents($url,true));

        $cities = array_map(function ($city) {
            return [
                'name'          =>  json_encode(['ar' => $city->governorate_name_ar , 'en' => $city->governorate_name_en ] , JSON_UNESCAPED_UNICODE),
                'id'    =>  $city->id,
                'created_at'    => Carbon::now()->subMonth(rand(0,8)),
            ];
        }, $citiesJson );
        
        DB::table('govs')->insert($cities) ;
    }
}
