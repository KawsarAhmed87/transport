<?php

use App\Model\Division;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $division = Division::where('name', 'All')->first();
        if (is_null($division)) {
            $division = new Division();
            $division->name = "All";
            $division->save();
        }
    }
}
