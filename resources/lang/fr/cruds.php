<?php

return [
    'userManagement' => [
        'title'          => 'Gestion des utilisateurs',
        'title_singular' => 'Gestion des utilisateurs',
    ],
    'permission'     => [
        'title'          => 'Autorisations',
        'title_list'          => 'List des Autorisations',
        'title_singular' => 'Autorisation',
        'edit_autorisation' => "Modifier l'autorisation",
        'show_autorisation' => "Afficher l'autorisation",
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'title'             => 'Titre',
            'title_helper'      => '',
            'created_at'        => 'Créé à',
            'created_at_helper' => '',
            'updated_at'        => 'Mis à jour à',
            'updated_at_helper' => '',
            'deleted_at'        => 'Supprimé à',
            'deleted_at_helper' => '',
        ],
    ],
    'role'           => [
        'title'          => 'Rôles',
        'title_singular' => 'Rôle',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'title'              => 'Titre',
            'title_helper'       => '',
            'permissions'        => 'Autorisations',
            'permissions_helper' => '',
            'created_at'         => 'Créé à',
            'created_at_helper'  => '',
            'updated_at'         => 'Mis à jour à',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Supprimé à',
            'deleted_at_helper'  => '',
        ],
    ],
    'user'           => [
        'title'          => 'Utilisateurs',
        'title_singular' => 'Utilisateur',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => '',
            'name'                     => 'Nom',
            'firstname'                     => 'Prénom',
            'lastname'                     => 'Nom',
            'name_helper'              => '',
            'email'                    => 'Email',
            'email_helper'             => '',
            'email_verified_at'        => 'Email vérifié à',
            'email_verified_at_helper' => '',
            'password'                 => 'Mot de passe',
            'password_helper'          => '',
            'roles'                    => 'Rôles',
            'roles_helper'             => '',
            'remember_token'           => 'Jeton de rappel',
            'remember_token_helper'    => '',
            'created_at'               => 'Créé à',
            'created_at_helper'        => '',
            'updated_at'               => 'Mis à jour à',
            'updated_at_helper'        => '',
            'deleted_at'               => 'Supprimé à',
            'deleted_at_helper'        => '',
        ],
    ],
    'service'        => [
        'title'          => 'Services',
        'title_singular' => 'Service',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Nom',
            'name_helper'       => '',
            'price'             => 'Prix',
            'price_helper'      => '',
            'created_at'        => 'Créé à',
            'created_at_helper' => '',
            'updated_at'        => 'Mis à jour à',
            'updated_at_helper' => '',
            'deleted_at'        => 'Supprimé à',
            'deleted_at_helper' => '',
        ],
    ],
    'employee'       => [
        'title'          => 'Employés',
        'title_singular' => 'Employé',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Nom',
            'name_helper'       => '',
            'email'             => 'Email',
            'email_helper'      => '',
            'phone'             => 'Téléphone',
            'phone_helper'      => '',
            'photo'             => 'Photo',
            'photo_helper'      => '',
            'services'          => 'Services',
            'services_helper'   => '',
            'created_at'        => 'Créé à',
            'created_at_helper' => '',
            'updated_at'        => 'Mis à jour à',
            'updated_at_helper' => '',
            'deleted_at'        => 'Supprimé à',
            'deleted_at_helper' => '',
        ],
    ],
    'client'         => [
        'title'          => 'Clients',
        'title_singular' => 'Client',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Nom',
            'name_helper'       => '',
            'phone'             => 'Téléphone',
            'phone_helper'      => '',
            'email'             => 'Email',
            'email_helper'      => '',
            'created_at'        => 'Créé à',
            'created_at_helper' => '',
            'updated_at'        => 'Mis à jour à',
            'updated_at_helper' => '',
            'deleted_at'        => 'Supprimé à',    
            'deleted_at_helper' => '',
        ],
    ],
    'booking'    => [
        'title'          => 'Réservations',
        'title_singular' => 'Réservation',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'client'             => 'Client',
            'client_helper'      => '',
            'start_time'         => 'Heure de début',
            'start_time_helper'  => '',
            'end_time'        => 'Heure de fin',
            'end_time_helper' => '',
            'price'              => 'Prix',
            'price_helper'       => '',
            'comment'           => 'Commentaire',
            'comment_helper'    => '',
            'services'           => 'Services',
            'services_helper'    => '',
            'created_at'         => 'Créé à',
            'created_at_helper'  => '',
            'updated_at'         => 'Mis à jour à',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Supprimé à',
            'deleted_at_helper'  => '',
        ],
    ],
    'cities' => [
        'title_singular'          => 'La Ville',
        'title_pluriel' => 'Les Villes',
        'new' => ' une nouvelle',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'region'             => 'Region',
            'region_pluriel'             => 'Regions',
            'province'           => 'Province',
            'province_pluriel'   => 'Provinces',
            'city'      => 'Ville',
            'city_pluriel'          => 'Les Ville',
            'cities_list'          => 'Liste des Villes',
            'name'               => 'Nom',
            'created_at'         => 'Créé le',
            'created_at_helper'  => '',
            'updated_at'         => 'Mis à jour le',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Supprimé le',
            'deleted_at_helper'  => '',
            'success_msg'  => 'la ville a été enregistrée avec succès',
            'error_msg'  => 'La ville n\'a pas été enregistrée avec succès',
        ],
    ],
    'youth_centers' => [
        'title_singular'          => 'Maison des jeunes',
        'title_pluriel' => 'Maisons des jeunes',
        'new' => 'New',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'name'             => 'Nom',
            'address'             => 'Adresse',
            'services'             =>[
                "name"=>"Service",
                "duration"=>"Durée",
                "max_places"=>"Nombre maximum de places",
                "status"=>"Statut",
            ],
            'city'               => 'Ville',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => '',
        ],
    ],   
];