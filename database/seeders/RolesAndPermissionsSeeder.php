<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // USER MODEL PERMISSION
        $userPermission1 = Permission::create(['name' => 'list users', 'description' => 'list of users']);
        $userPermission2 = Permission::create(['name' => 'view users', 'description' => 'view user']);
        $userPermission3 = Permission::create(['name' => 'create users', 'description' => 'create users']);
        $userPermission4 = Permission::create(['name' => 'update users', 'description' => 'update users']);
        $userPermission5 = Permission::create(['name' => 'delete users', 'description' => 'delete Users']);

        // ROLE MODEL PERMISSION
        $rolePermission1 = Permission::create(['name' => 'list role', 'description' => 'list of roles']);
        $rolePermission2 = Permission::create(['name' => 'view role', 'description' => 'view user']);
        $rolePermission3 = Permission::create(['name' => 'create role', 'description' => 'create role']);
        $rolePermission4 = Permission::create(['name' => 'update role', 'description' => 'update role']);
        $rolePermission5 = Permission::create(['name' => 'delete role', 'description' => 'delete role']);

        // PERMISSION MODEL
        $permission1 = Permission::create(['name' => 'list permissions', 'description' => 'list of permissions']);
        $permission2 = Permission::create(['name' => 'view permissions', 'description' => 'view permission']);
        $permission3 = Permission::create(['name' => 'create permissions', 'description' => 'create permission']);
        $permission4 = Permission::create(['name' => 'update permissions', 'description' => 'update permission']);
        $permission5 = Permission::create(['name' => 'delete permissions', 'description' => 'delete permission']);

        // ADMINS PERMISSION
        $adminPermission1 = Permission::create(['name' => 'list admin', 'description' => 'list of admin']);
        $adminPermission2 = Permission::create(['name' => 'view admin', 'description' => 'view admin']);
        $adminPermission3 = Permission::create(['name' => 'create admin', 'description' => 'create admin']);
        $adminPermission4 = Permission::create(['name' => 'update admin', 'description' => 'update admin']);
        $adminPermission5 = Permission::create(['name' => 'delete admin', 'description' => 'delete admin']);

        // Misc
        $miscPermission = Permission::create(['name' => 'N/A', 'description' => 'N/A']);

        // CREATION DE ROLE
        $superAdminRole = Role::create(['name' => 'super-admin']);
        $adminRole = Role::create(['name' => 'admin']);
        $moderatorRole = Role::create(['name' => 'moderator']);
        $developerRole = Role::create(['name' => 'developer']);
        $userRole = Role::create(['name' => 'user']);

        // ATTRIBUTION DE PERMISSION AU DIFFERENT ROLE
        $superAdminRole->givePermissionTo(Permission::all());

         $adminRole->syncPermissions([
            $userPermission1,
            $userPermission2,
            $userPermission3,
            $userPermission4,
            $userPermission5,

            $rolePermission1,
            $rolePermission2,
            $rolePermission3,
            $rolePermission4,
            $rolePermission5,

            $permission1,
            $permission2,
            $permission3,
            $permission4,
            $permission5,

            $adminPermission1,
            $adminPermission2,
            $adminPermission3,
            $adminPermission4,
            $adminPermission5,
        ]);

        $moderatorRole->syncPermissions([
            $userPermission1,
            $userPermission2,

            $rolePermission1,
            $rolePermission2,

            $permission1,
            $permission2,

            $adminPermission1,
            $adminPermission2,
        ]);

        $developerRole->syncPermissions([
            $adminPermission1,
            $adminPermission2,
        ]);

        $userRole->syncPermissions([
            $miscPermission,
        ]);

        // CREATION D'UTILISATEUR PAR DEFAUT
        $superAdmin = User::create([
            'name' => 'super admin',
            'is_admin' => 1,
            'email' => 'super@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        $admin = User::create([
            'name' => 'admin',
            'is_admin' => 1,
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        $moderator = User::create([
            'name' => 'moderator',
            'is_admin' => 1,
            'email' => 'moderator@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        $developer = User::create([
            'name' => 'developer',
            'is_admin' => 1,
            'email' => 'developer@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        $user = User::create([
            'name' => 'test',
            'is_admin' => 0,
            'email' => 'test@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        // ATTRIBUTION DE ROLE AU UTILISATEUR CREER
        $superAdmin->assignRole([$superAdminRole]);

        $admin->assignRole([$adminRole]);

        $moderator->syncRoles($moderatorRole);

        $developer->syncRoles($developerRole);

        $user->syncRoles($userRole);
    }
}
