<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OfficeSpaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
      public function run()
    {
        // IDs kota yang tersedia untuk office spaces
        // Pastikan ID ini ada di tabel `cities` Anda
        $availableCityIds = range(11, 19); // Membuat array dari 11 sampai 19

        $officeSpaces = [];

        // Generate 10 sample office spaces
        for ($i = 1; $i <= 10; $i++) {
            $name = "Office Space " . $i;
            $about = "Ini adalah deskripsi singkat untuk Office Space " . $i . ". Tempat ini dirancang untuk kenyamanan dan produktivitas Anda.";

            $officeSpaces[] = [
                'name' => $name,
                'slug' => Str::slug($name . '-' . Str::random(5)), // Tambahkan random string untuk memastikan slug unik
                'thumbnail' => '[https://placehold.co/600x400/F0F0F0/000000?text=OfficeSpace](https://placehold.co/600x400/F0F0F0/000000?text=OfficeSpace)' . $i, // Placeholder image
                'about' => $about,
                'city_id' => $availableCityIds[array_rand($availableCityIds)], // Pilih city_id secara acak dari array
                'is_open' => (bool)rand(0, 1), // Acak true/false
                'is_full_booked' => false, // Default false, bisa diubah jika perlu
                'price' => rand(500000, 5000000), // Harga acak antara 500rb - 5jt
                'duration' => rand(1, 12), // Durasi acak (misal: bulan)
                'address' => 'Jalan Contoh No. ' . rand(1, 100) . ', Kota ID ' . $availableCityIds[array_rand($availableCityIds)], // Alamat contoh
                'rating' => mt_rand(1,5),
                'created_at' => now(),
                'updated_at' => now(),
                // softDeletes tidak perlu diisi saat insert, hanya akan terisi jika di-soft delete
            ];
        }

        // Insert data ke tabel office_spaces
        DB::table('office_spaces')->insert($officeSpaces);
    }
}
