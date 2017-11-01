<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        User::create(array(
            'name'     => 'Josu',
            'email'    => 'josufmc@hotmail.com',
            'password' => Hash::make('passw')
        ));

        User::create(array(
            'name'     => 'Jorge',
            'email'    => 'jorge@hotmail.com',
            'password' => Hash::make('passw')
        ));

        User::create(array(
            'name'     => 'Estudiante',
            'email'    => 'estudiante@hotmail.com',
            'password' => Hash::make('passw')
        ));
    }
}
