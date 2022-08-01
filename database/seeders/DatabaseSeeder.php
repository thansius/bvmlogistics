<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert(
            [[
                'username' => 20220001,
                'password' => Hash::make("admin"),
                'role' => "admin"
            ],
            [
                'username' => 20220002,
                'password' => Hash::make("santos991211"),
                'role' => "Department Head"
            ],
            [
                'username' => 20220003,
                'password' => Hash::make("david040626"),
                'role' => "Staff"
            ],
            [
                'username' => 20220004,
                'password' => Hash::make("torres980727"),
                'role' => "Carrier"
            ],]
        );

        DB::table('employees')->insert(
            [[
                'lastName' => 'Gomez',
                'firstName' => 'Jenel',
                'middleName' => 'Pineda',
                'position' => 'Administrator',
                'birthday' => '1998-11-26',
                'department' => 'IT',
                'contactNumber' => '(0961) 270-8428'
            ],
            [
                'lastName' => 'Santos',
                'firstName' => 'Mark',
                'middleName' => '',
                'position' => 'Deparment Head',
                'birthday' => '1999-12-11',
                'department' => 'Finance',
                'contactNumber' => '(0961) 270-8428'
            ],
            [
                'lastName' => 'David',
                'firstName' => 'John',
                'middleName' => 'Lopez',
                'position' => 'Staff',
                'birthday' => '2004-06-26',
                'department' => 'Human Resources',
                'contactNumber' => '(0927) 610-9785'
            ],
            [
                'lastName' => 'Torres',
                'firstName' => 'Ronnel',
                'middleName' => 'Tolentino',
                'position' => 'Carrier',
                'birthday' => '1998-07-27',
                'department' => 'Delivery',
                'contactNumber' => '(0912) 654-4257'
            ]]
        );

    }
}
