<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'id'        => 1,
                'name'     => 'admin_mjcc',
                'title'      => 'Admin MJCC',
            ],
            [
                'id'        => 2,
                'name'     => 'directeur_regional',
                'title'      => 'Directeur régional',
            ],
            [
                'id'         => 3,
                'name'      => 'directeur_provincial',
                'title'       => 'Directeur provincial',
            ],
            [
                'id'         => 4,
                'name'      => 'directeur_maison_jeunes',
                'title'      => 'Directeur de maison de jeunes',
            ],
        ];

        Role::insert($roles);
    }
}
