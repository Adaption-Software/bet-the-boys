<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $adminPermission = Permission::create(['name' => 'manage users']);

        $adminRole->givePermissionTo($adminPermission);

        $groupLeader = Role::create(['name' => 'group leader']);
        $groupLeaderPermission = Permission::create(['name' => 'manage groups']);

        $groupLeader->givePermissionTo($groupLeaderPermission);

        $groupMember = Role::create(['name' => 'group member']);
        $groupMemberPermission = Permission::create(['name' => 'can see group']);

        $groupMember->givePermissionTo($groupMemberPermission);

        $user = User::where('email', 'admin@example.com')->first();

        $user->assignRole([$adminRole, $groupLeader, $groupMember]);
    }
}
