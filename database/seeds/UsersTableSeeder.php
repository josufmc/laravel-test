<?php

use App\User;
use App\Role;
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
        DB::table('assigned_roles')->truncate();
        User::truncate();

        $user = User::create(array(
            'name'     => 'Josu',
            'email'    => 'josufmc@hotmail.com',
            'password' => Hash::make('passw')
        ));

        $user->roles()->save(Role::findOrFail(1));

        $user = User::create(array(
            'name'     => 'Jorge',
            'email'    => 'jorge@hotmail.com',
            'password' => Hash::make('passw')
        ));

        $user->roles()->save(Role::findOrFail(2));
        $user->roles()->save(Role::findOrFail(3));

        $user = User::create(array(
            'name'     => 'Estudiante',
            'email'    => 'estudiante@hotmail.com',
            'password' => Hash::make('passw')
        ));

        $user->roles()->save(Role::findOrFail(3));
    }
}
