<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([  
            'footer_desc'=>  json_encode(['ar' => 'خصم يصل الي ٧٠ في المئه علي كل الملابس' , 'en' => 'sale up to 70% on all products' ] , JSON_UNESCAPED_UNICODE),
            'fb_link'    =>  'facebook.com',
            'insta_link' =>  'facebook.com',
            'tw_link' =>  'facebook.com',
            'you_link' =>  'facebook.com',
            'wha_link'=>  'facebook.com',
            
            
            'created_at'    => Carbon::now()->subMonth(rand(0,8)),
        ]);
    }
}
