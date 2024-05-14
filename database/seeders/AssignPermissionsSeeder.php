<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AssignPermissionsSeeder extends Seeder
{
    public function run()
    {
        $roleOwner = Role::where('name', 'owner')->first();
        $roleManager = Role::where('name', 'manager')->first();
        $roleCashier = Role::where('name', 'cashier')->first();

        $permissionRead = Permission::where('name', 'read')->first();
        $permissionWrite = Permission::where('name', 'write')->first();
        $permissionDelete = Permission::where('name', 'delete')->first();

        $roleOwner->givePermissionTo($permissionRead, $permissionWrite, $permissionDelete);
        $roleManager->givePermissionTo($permissionRead, $permissionWrite);
        $roleCashier->givePermissionTo($permissionRead);
    }
}
