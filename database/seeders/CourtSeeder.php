<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Court;

class CourtSeeder extends Seeder
{
    public function run(): void
    {   
        // Seed courts for Ambadminton
        Court::create([
            'venue_id'   => 1,
            'court_name' => 'Court A',
            'is_active'  => true,
        ]);

        Court::create([
            'venue_id'   => 1,
            'court_name' => 'Court B',
            'is_active'  => true,
        ]);

        Court::create([
            'venue_id'   => 1,
            'court_name' => 'Court C',
            'is_active'  => true,
        ]);

        Court::create([
            'venue_id'   => 1,
            'court_name' => 'Court D',
            'is_active'  => true,
        ]);

        //Seed courts for Ambadel
        Court::create([
            'venue_id'   => 2,
            'court_name' => 'Court 1',
            'is_active'  => true,
        ]);

        Court::create([
            'venue_id'   => 2,
            'court_name' => 'Court 2',
            'is_active'  => true,
        ]);

        Court::create([
            'venue_id'   => 2,
            'court_name' => 'Court 3',
            'is_active'  => true,
        ]);

        Court::create([
            'venue_id'   => 2,
            'court_name' => 'Court 4',
            'is_active'  => true,
        ]);

        // Seed courts for Amba Tennis
        Court::create([
            'venue_id'   => 3,
            'court_name' => 'Court I',
            'is_active'  => true,
        ]);

        Court::create([
            'venue_id'   => 3,
            'court_name' => 'Court II',
            'is_active'  => true,
        ]);

        Court::create([
            'venue_id'   => 3,
            'court_name' => 'Court III',
            'is_active'  => true,
        ]);

        Court::create([
            'venue_id'   => 3,
            'court_name' => 'Court IV',
            'is_active'  => true,
        ]);

        // Seed courts for Amba Pickleball
        Court::create([
            'venue_id'   => 4,
            'court_name' => 'Court Alpha',
            'is_active'  => true,
        ]);

        Court::create([
            'venue_id'   => 4,
            'court_name' => 'Court Beta',
            'is_active'  => true,
        ]);

        Court::create([
            'venue_id'   => 4,
            'court_name' => 'Court Gamma',
            'is_active'  => true,
        ]);

        Court::create([
            'venue_id'   => 4,
            'court_name' => 'Court Delta',
            'is_active'  => true,
        ]);
    }
}
