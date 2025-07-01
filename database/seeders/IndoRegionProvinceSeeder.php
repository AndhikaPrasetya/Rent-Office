<?php

/*
 * This file is part of the IndoRegion package.
 *
 * (c) Azis Hapidin <azishapidin.com | azishapidin@gmail.com>
 *
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use AzisHapidin\IndoRegion\RawDataGetter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
        // Get all provinces
        $provinces = RawDataGetter::getProvinces(); // This will be an array of associative arrays

        $citiesToInsert = [];
        foreach ($provinces as $province) {
            // Assuming your 'cities' table needs 'id', 'name', 'slug', 'province_id' (foreign key)
            // Adjust column names ('province_id') based on your 'cities' table schema
            $citiesToInsert[] = [
                // If your 'cities' table needs an 'id' that maps to the province's ID:
                'id'          => (string) $province['id'], // Ensure it's a string if cities.id is CHAR
                'name'        => $province['name'],
                'slug'        => Str::slug($province['name']), // Generate a slug from the name

                // Add timestamps if your 'cities' table has them
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        // Insert all prepared city data into the 'cities' table
        DB::table('cities')->insert($citiesToInsert);
    }
}
