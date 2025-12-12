<?php

namespace Database\Seeders;

use App\Models\Venue;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bucket = env('SUPABASE_BUCKET');
        $localPath = public_path('storage/seed/venues');

        // Ambil semua file gambar di folder
        $files = scandir($localPath);

        $venues = [
            [
                'name'           => 'Ambadel',
                'type'           => 'padel',
                'space'          => 'indoor',
                'location'       => 'Jl. Basing no. 67',
                'description'    => 'Fasilitas: kamar mandi, ruang ganti, ganti senar',
                'price_per_hour' => 90000
            ],
            [
                'name'           => 'Amba Tennis',
                'type'           => 'tenis',
                'space'          => 'outdoor',
                'location'       => 'Jl. Ngawi Selatan no. 88',
                'description'    => 'Lapangan tenis berstandar internasional',
                'price_per_hour' => 120000
            ],
            [
                'name'           => 'Amba Pickleball',
                'type'           => 'pickleball',
                'space'          => 'outdoor',
                'location'       => 'Jl. Tunat no. 4',
                'description'    => 'Seru-seruan bareng main pickleball cuma di Amba Pickleball',
                'price_per_hour' => 100000
            ]
        ];

        $i = 0;

        foreach ($files as $file) {

            if ($file === '.' || $file === '..') continue;

            $fullPath = $localPath . '/' . $file;

            $filename = time() . '_' . $file;

            // Upload ke Supabase
            $uploadUrl = env('SUPABASE_URL') . "/storage/v1/object/$bucket/$filename";

            $response = Http::withHeaders([
                'apikey'        => env('SUPABASE_KEY'),
                'Authorization' => 'Bearer ' . env('SUPABASE_KEY'),
            ])->attach(
                'file',
                file_get_contents($fullPath),
                $filename
            )->post(env('SUPABASE_URL') . "/storage/v1/object/$bucket/$filename");


            if (!$response->successful()) {
                dump("Upload failed for: $file");
                continue;
            }

            // URL publik Supabase
            $publicUrl = env('SUPABASE_URL') . "/storage/v1/object/public/$bucket/$filename";

            // Simpan ke database
            Venue::create([
                'name' => $venues[$i]['name'],
                'type'           => $venues[$i]['type'],
                'space'          => $venues[$i]['space'],
                'location'       => $venues[$i]['location'],
                'description'    => $venues[$i]['description'],
                'price_per_hour' => $venues[$i]['price_per_hour'],
                'venue_image'   => $publicUrl
            ]);

            $i++;
            if ($i >= count($venues)) break; // Biar tidak over-seed
        }
    }
}
