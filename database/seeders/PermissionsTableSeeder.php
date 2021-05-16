<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'erplist_access',
            ],
            [
                'id'    => 18,
                'title' => 'erpname_create',
            ],
            [
                'id'    => 19,
                'title' => 'erpname_edit',
            ],
            [
                'id'    => 20,
                'title' => 'erpname_show',
            ],
            [
                'id'    => 21,
                'title' => 'erpname_delete',
            ],
            [
                'id'    => 22,
                'title' => 'erpname_access',
            ],
            [
                'id'    => 23,
                'title' => 'zone_create',
            ],
            [
                'id'    => 24,
                'title' => 'zone_edit',
            ],
            [
                'id'    => 25,
                'title' => 'zone_show',
            ],
            [
                'id'    => 26,
                'title' => 'zone_delete',
            ],
            [
                'id'    => 27,
                'title' => 'zone_access',
            ],
            [
                'id'    => 28,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 29,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 30,
                'title' => 'asset_management_access',
            ],
            [
                'id'    => 31,
                'title' => 'category_create',
            ],
            [
                'id'    => 32,
                'title' => 'category_edit',
            ],
            [
                'id'    => 33,
                'title' => 'category_show',
            ],
            [
                'id'    => 34,
                'title' => 'category_delete',
            ],
            [
                'id'    => 35,
                'title' => 'category_access',
            ],
            [
                'id'    => 36,
                'title' => 'vendor_create',
            ],
            [
                'id'    => 37,
                'title' => 'vendor_edit',
            ],
            [
                'id'    => 38,
                'title' => 'vendor_show',
            ],
            [
                'id'    => 39,
                'title' => 'vendor_delete',
            ],
            [
                'id'    => 40,
                'title' => 'vendor_access',
            ],
            [
                'id'    => 41,
                'title' => 'status_create',
            ],
            [
                'id'    => 42,
                'title' => 'status_edit',
            ],
            [
                'id'    => 43,
                'title' => 'status_show',
            ],
            [
                'id'    => 44,
                'title' => 'status_delete',
            ],
            [
                'id'    => 45,
                'title' => 'status_access',
            ],
            [
                'id'    => 46,
                'title' => 'instock_create',
            ],
            [
                'id'    => 47,
                'title' => 'instock_edit',
            ],
            [
                'id'    => 48,
                'title' => 'instock_show',
            ],
            [
                'id'    => 49,
                'title' => 'instock_delete',
            ],
            [
                'id'    => 50,
                'title' => 'instock_access',
            ],
            [
                'id'    => 51,
                'title' => 'outward_create',
            ],
            [
                'id'    => 52,
                'title' => 'outward_edit',
            ],
            [
                'id'    => 53,
                'title' => 'outward_show',
            ],
            [
                'id'    => 54,
                'title' => 'outward_delete',
            ],
            [
                'id'    => 55,
                'title' => 'outward_access',
            ],
            [
                'id'    => 56,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
