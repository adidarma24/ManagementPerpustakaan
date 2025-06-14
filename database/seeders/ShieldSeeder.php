<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use BezhanSalleh\FilamentShield\Support\Utils;
use Spatie\Permission\PermissionRegistrar;

class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesWithPermissions = '[{"name":"super_admin","guard_name":"web","permissions":["view_role","view_any_role","create_role","update_role","delete_role","delete_any_role","view_author","view_any_author","create_author","update_author","restore_author","restore_any_author","replicate_author","reorder_author","delete_author","delete_any_author","force_delete_author","force_delete_any_author","view_book","view_any_book","create_book","update_book","restore_book","restore_any_book","replicate_book","reorder_book","delete_book","delete_any_book","force_delete_book","force_delete_any_book","view_category::book","view_any_category::book","create_category::book","update_category::book","restore_category::book","restore_any_category::book","replicate_category::book","reorder_category::book","delete_category::book","delete_any_category::book","force_delete_category::book","force_delete_any_category::book","view_peminjaman","view_any_peminjaman","create_peminjaman","update_peminjaman","restore_peminjaman","restore_any_peminjaman","replicate_peminjaman","reorder_peminjaman","delete_peminjaman","delete_any_peminjaman","force_delete_peminjaman","force_delete_any_peminjaman","view_publisher","view_any_publisher","create_publisher","update_publisher","restore_publisher","restore_any_publisher","replicate_publisher","reorder_publisher","delete_publisher","delete_any_publisher","force_delete_publisher","force_delete_any_publisher","view_user","view_any_user","create_user","update_user","restore_user","restore_any_user","replicate_user","reorder_user","delete_user","delete_any_user","force_delete_user","force_delete_any_user"]}]';
        $directPermissions = '[]';

        static::makeRolesWithPermissions($rolesWithPermissions);
        static::makeDirectPermissions($directPermissions);

        $this->command->info('Shield Seeding Completed.');
    }

    protected static function makeRolesWithPermissions(string $rolesWithPermissions): void
    {
        if (! blank($rolePlusPermissions = json_decode($rolesWithPermissions, true))) {
            /** @var Model $roleModel */
            $roleModel = Utils::getRoleModel();
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($rolePlusPermissions as $rolePlusPermission) {
                $role = $roleModel::firstOrCreate([
                    'name' => $rolePlusPermission['name'],
                    'guard_name' => $rolePlusPermission['guard_name'],
                ]);

                if (! blank($rolePlusPermission['permissions'])) {
                    $permissionModels = collect($rolePlusPermission['permissions'])
                        ->map(fn ($permission) => $permissionModel::firstOrCreate([
                            'name' => $permission,
                            'guard_name' => $rolePlusPermission['guard_name'],
                        ]))
                        ->all();

                    $role->syncPermissions($permissionModels);
                }
            }
        }
    }

    public static function makeDirectPermissions(string $directPermissions): void
    {
        if (! blank($permissions = json_decode($directPermissions, true))) {
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($permissions as $permission) {
                if ($permissionModel::whereName($permission)->doesntExist()) {
                    $permissionModel::create([
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                    ]);
                }
            }
        }
    }
}
