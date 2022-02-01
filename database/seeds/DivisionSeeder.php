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
            ['name' => 'All'],
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
            ['name' => 'Jeep'],
            ['name' => 'Double cabin pickup'],
            ['name' => 'Single cabin pickup'],
            ['name' => 'Microbus'],
            ['name' => 'Car'],
        ]);

    }
}
