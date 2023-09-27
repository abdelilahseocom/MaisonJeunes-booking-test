<?php
use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'         => '1',
                'name'      => 'user_management_access',
                'title'       => 'Accès à la gestion des utilisateurs',
            ],
            [
                'id'         => '2',
                'name'      => 'permission_create',
                'title'       => 'Créer une autorisation',
            ],
            [
                'id'         => '3',
                'name'      => 'permission_edit',
                'title'       => "Modifier l'autorisations",
            ],
            [
                'id'         => '4',
                'name'      => 'permission_show',
                'title'       => 'Afficher les autorisations',
            ],
            [
                'id'         => '5',
                'name'      => 'permission_delete',
                'title'       => "Supprimer l'autorisations",
            ],
            [
                'id'         => '6',
                'name'      => 'permission_access',
                'title'       => 'Accès aux autorisations',
            ],
            [
                'id'         => '7',
                'name'      => 'role_create',
                'title'       => 'Créer un rôle',
            ],
            [
                'id'         => '8',
                'name'      => 'role_edit',
                'title'       => 'Modifier un rôle',
            ],
            [
                'id'         => '9',
                'name'      => 'role_show',
                'title'       => 'Afficher les rôles',
            ],
            [
                'id'         => '10',
                'name'      => 'role_delete',
                'title'       => "Supprimer un rôle",
            ],
            [
                'id'         => '11',
                'name'      => 'role_access',
                'title'       => "Accès au rôle",
            ],
            [
                'id'         => '12',
                'name'      => 'user_create',
                'title'       => "Créer un utilisateur",
            ],
            [
                'id'         => '13',
                'name'      => 'user_edit',
                'title'       => "Modifier l'utilisateur",
            ],
            [
                'id'         => '14',
                'name'      => 'user_show',
                'title'       => "Afficher l'utilisateur",
            ],
            [
                'id'         => '15',
                'name'      => 'user_delete',
                'title'       => "Supprimer l'utilisateur",
            ],
            [
                'id'         => '16',
                'name'      => 'user_access',
                'title'       => "Accès à l'utilisateur",
            ],
            [
                'id'         => '17',
                'name'      => 'service_create',
                'title'       => "Créer un service",
            ],
            [
                'id'         => '18',
                'name'      => 'service_edit',
                'title'       => "Modifier le service",
            ],
            [
                'id'         => '19',
                'name'      => 'service_show',
                'title'       => "Afficher le service",
            ],
            [
                'id'         => '20',
                'name'      => 'service_delete',
                'title'       => "Supprimer le service",
            ],
            [
                'id'         => '21',
                'name'      => 'service_access',
                'title'       => "Accès au service",
            ],
            [
                'id'         => '22',
                'name'      => 'youth-center_create',
                'title'       => "Créer la maison des jeunes",
            ],
            [
                'id'         => '23',
                'name'      => 'youth-center_edit',
                'title'       => "Modifier la maison des jeunes",
            ],
            [
                'id'         => '24',
                'name'      => 'youth-center_show',
                'title'       => "Afficher la maison des jeunes",
            ],
            [
                'id'         => '25',
                'name'      => 'youth-center_delete',
                'title'       => "Supprimer la maison des jeunes",
            ],
            [
                'id'         => '26',
                'name'      => 'youth-center_access',
                'title'       => "Accès au maison des jeunes",
            ],
            [
                'id'         => '27',
                'name'      => 'client_create',
                'title'       => "Créer un client",
            ],
            [
                'id'         => '28',
                'name'      => 'client_edit',
                'title'       => "Modifier le client",
            ],
            [
                'id'         => '29',
                'name'      => 'client_show',
                'title'       => "Afficher le client",
            ],
            [
                'id'         => '30',
                'name'      => 'client_delete',
                'title'       => "Supprimer le client",
            ],
            [
                'id'         => '31',
                'name'      => 'client_access',
                'title'       => "Accès au client",
            ],
            [
                'id'         => '32',
                'name'      => 'booking_create',
                'title'       => "Créer une réservation",
            ],
            [
                'id'         => '33',
                'name'      => 'booking_edit',
                'title'       => "Modifier la réservation",
            ],
            [
                'id'         => '34',
                'name'      => 'booking_show',
                'title'       => "Afficher la réservation",
            ],
            [
                'id'         => '35',
                'name'      => 'booking_delete',
                'title'       => "Supprimer la réservation",
            ],
            [
                'id'         => '36',
                'name'      => 'booking_access',
                'title'       => "Accès à la réservation",
            ],
            [
                'id'         => '37',
                'name'      => 'city_create',
                'title'       => "Créer une ville",
            ],
            [
                'id'         => '38',
                'name'      => 'city_edit',
                'title'       => "Modifier la ville",
            ],
            [
                'id'         => '39',
                'name'      => 'city_show',
                'title'       => "Afficher la ville",
            ],
            [
                'id'         => '40',
                'name'      => 'city_delete',
                'title'       => "Supprimer la ville",
            ],
            [
                'id'         => '41',
                'name'      => 'city_access',
                'title'       => "Accès à la ville",
            ]
        ];

        Permission::insert($permissions);
    }
}
