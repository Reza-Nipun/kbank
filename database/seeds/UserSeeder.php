<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'name' => 'Nipun',
                'email' => 'nipun.sarker@interfabshirt.com',
                'password' => Hash::make('12345678'),
                'access_level' => 0,
                'status' => 1,
            ]
        );
    }
}
