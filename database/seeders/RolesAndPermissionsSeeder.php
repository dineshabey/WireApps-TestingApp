<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define roles
        $roleOwner = Role::create(['name' => 'owner']);
        $roleManager = Role::create(['name' => 'manager']);
        $roleCashier = Role::create(['name' => 'cashier']);

        // Assign roles based on the User's Role field
        User::all()->each(function ($user) use ($roleOwner, $roleManager, $roleCashier) {
            switch ($user->Role) {
                case 'owner':
                    $user->assignRole($roleOwner);
                    break;
                case 'manager':
                    $user->assignRole($roleManager);
                    break;
                case 'cashier':
                    $user->assignRole($roleCashier);
                    break;
                default:
                    // Handle default role assignment
                    break;
            }
        });
    }
}
