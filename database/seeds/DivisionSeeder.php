<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('divisions')->insert([
            ['name' => 'N/A'],
            ['name' => 'Chairman'],
            ['name' => 'Managing Director'],
        ]);

        DB::table('colours')->insert([
            ['name' => 'Black'],
            ['name' => 'White'],
            ['name' => 'Red'],
        ]);

        DB::table('brands')->insert([
            ['name' => 'Toyota'],
            ['name' => 'Nissan'],
            ['name' => 'Honda'],
        ]);

        DB::table('units')->insert([
            ['name' => 'Set'],
            ['name' => 'Piece'],
            ['name' => 'Litter'],
        ]);

        DB::table('vehicletypes')->insert([
            ['name' => 'Jeep', 'parent_id' => 0],
            ['name' => 'Pickup', 'parent_id' => 0],
            ['name' => 'Microbus', 'parent_id' => 0],
            ['name' => 'Car', 'parent_id' => 0],
            ['name' => 'Pajero Sports', 'parent_id' => 1],
            ['name' => 'Pajero Jeep', 'parent_id' => 1],
            ['name' => 'Double Cabin Pickup', 'parent_id' => 2],
            ['name' => 'Single Cabin Pickup', 'parent_id' => 2],
        ]);

    }
}
