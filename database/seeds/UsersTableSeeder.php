<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'superadmin@mail.com')->first();
        if (is_null($user)) {
            $user = new User();
            $user->name = "Mr. XYZ";
            $user->email = "superadmin@mail.com";
            $user->password = Hash::make('Admin@100%');
            $user->division_id = 1;
            $user->save();
        }
    }
}
