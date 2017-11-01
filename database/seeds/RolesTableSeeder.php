<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        Role::create(array(
            'name' => 'admin',
            'display_name' => 'Administrador',
            'description' => 'Administrador del sitio'
        ));

        Role::create(array(
            'name' => 'moderator',
            'display_name' => 'Moderador',
            'description' => 'Moderador del sitio'
        ));

        Role::create(array(
            'name' => 'student',
            'display_name' => 'Estudiante',
            'description' => 'Estudiante'
        ));
    }
}
