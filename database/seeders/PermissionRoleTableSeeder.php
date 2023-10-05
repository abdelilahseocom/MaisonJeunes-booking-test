<?php

namespace Database\Seeders;
use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $allPermissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($allPermissions->pluck('id'));

        $permission_directeur_regional = $allPermissions->filter(function ($permission) {
            return in_array(explode("_",$permission->name),[""]);
        });
        // dd($permission_directeur_regional->pluck("id","name","title"));
        Role::findOrFail(2)->permissions()->sync($permission_directeur_regional);

        
        $permission_directeur_provincial = $allPermissions->filter(function ($permission) {
            return in_array(explode("_",$permission->name),[""]);
        });
        // dd($permission_directeur_provincial->pluck("id","name","title"));
        Role::findOrFail(3)->permissions()->sync($permission_directeur_provincial);

        
        $permission_directeur_youth_center = $allPermissions->filter(function ($permission) {
            return in_array($permission->name,["youth-center_access","youth-center_edit","youth-center_show"]);
        });
        // dd($permission_directeur_youth_center->pluck("id","name","title"));
        Role::findOrFail(4)->permissions()->sync($permission_directeur_youth_center);
    }
}
