<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name'=>'Tommy',
            'last_name'=>'limmm',
            'username'=>'GeneralTommy',
            'role'=>'admin',
            'email'=>'generaltommy@yahoo.com',
            'gender'=>'male',
            'tgl_lahir'=>'2003-01-09',
            'password'=>Hash::make('123456789')
        ]);
    }
}
