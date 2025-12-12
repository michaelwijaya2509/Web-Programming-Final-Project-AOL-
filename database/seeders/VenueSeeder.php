<?php

namespace Database\Seeders;

use App\Models\Venue;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Venue::create([
            'name'           => 'Ambadminton',
            'type'           => 'badminton',
            'space'          => 'indoor',
            'location'       => 'Jl. Tukam no. 69',
            'description'    => 'Fasilitas: kamar mandi, ruang ganti, ruang sauna',
            'price_per_hour' => 50000,
            'venue_image'    => 'storage/ambadminton.jpeg',
        ]);

        Venue::create([
            'name'           => 'Ambadel',
            'type'           => 'padel',
            'location'       => 'Jl. Basing no. 67',
            'description'    => 'Fasilitas: kamar mandi, ruang ganti, ganti senar',
            'price_per_hour' => 90000,
            'venue_image'    => 'storage/ambadel.jpeg',
        ]);

        Venue::create([
            'name'           => 'Amba Tennis',
            'type'           => 'tenis',
            'location'       => 'Jl. Ngawi Selatan no. 88',
            'description'    => 'Lapangan tenis berstandar internasional',
            'price_per_hour' => 120000,
            'venue_image'    => 'storage/ambatennis.jpg',
        ]);

        Venue::create([
            'name'           => 'Amba Pickleball',
            'type'           => 'pickleball',
            'location'       => 'Jl. Tunat no. 4',
            'description'    => 'Seru-seruan bareng main pickleball cuma di Amba Pickleball',
            'price_per_hour' => 100000,
            'venue_image'    => 'storage/pickleball.jpg',
        ]);
    }
}
