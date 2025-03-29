<?php

/*
 * This file is part of the IndoRegion package.
 *
 * (c) Azis Hapidin <azishapidin.com | azishapidin@gmail.com>
 *
 */

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use AzisHapidin\IndoRegion\RawDataGetter;

class IndoRegionProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @deprecated
     * 
     * @return void
     */
    public function run()
    {
        // Get Data
        $provinces = RawDataGetter::getProvinces();

        //tambah slug ke setiap item 
       $data = [];
       foreach($provinces as $province){
        $data [] =[
            'name' =>$province['name'],
            'slug' => Str::slug($province['name']),
            'photo' => 'public/image/gedung.jpg'
        ];
       }
        // Insert Data to Database
        DB::table('cities')->insert($data);
    }
}
