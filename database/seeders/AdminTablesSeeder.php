<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class AdminTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // base tables
        \Encore\Admin\Auth\Database\Menu::truncate();
        \Encore\Admin\Auth\Database\Menu::insert(
            [
                [
                    "parent_id" => 0,
                    "order" => 1,
                    "title" => "Dashboard",
                    "icon" => "fa-bar-chart",
                    "uri" => "/",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 0,
                    "order" => 2,
                    "title" => "Admin",
                    "icon" => "fa-tasks",
                    "uri" => "",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 2,
                    "order" => 3,
                    "title" => "Users",
                    "icon" => "fa-users",
                    "uri" => "auth/users",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 2,
                    "order" => 4,
                    "title" => "Roles",
                    "icon" => "fa-user",
                    "uri" => "auth/roles",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 2,
                    "order" => 5,
                    "title" => "Permission",
                    "icon" => "fa-ban",
                    "uri" => "auth/permissions",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 2,
                    "order" => 6,
                    "title" => "Menu",
                    "icon" => "fa-bars",
                    "uri" => "auth/menu",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 2,
                    "order" => 7,
                    "title" => "Operation log",
                    "icon" => "fa-history",
                    "uri" => "auth/logs",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 0,
                    "order" => 10,
                    "title" => "Boxes",
                    "icon" => "fa-list",
                    "uri" => "boxes",
                    "permission" => "boxes"
                ],
                [
                    "parent_id" => 0,
                    "order" => 10,
                    "title" => "Users",
                    "icon" => "fa-list",
                    "uri" => "users",
                    "permission" => "users"
                ],
                [
                    "parent_id" => 0,
                    "order" => 10,
                    "title" => "Addresses",
                    "icon" => "fa-list",
                    "uri" => "addresses",
                    "permission" => "addresses"
                ],
                [
                    "parent_id" => 0,
                    "order" => 10,
                    "title" => "Orders",
                    "icon" => "fa-list",
                    "uri" => "orders",
                    "permission" => "orders"
                ],
                [
                    "parent_id" => 0,
                    "order" => 10,
                    "title" => "Reviews",
                    "icon" => "fa-list",
                    "uri" => "reviews",
                    "permission" => "reviews"
                ]
            ]
        );

        \Encore\Admin\Auth\Database\Permission::truncate();
        \Encore\Admin\Auth\Database\Permission::insert(
            [
                [
                    "name" => "All permission",
                    "slug" => "*",
                    "http_method" => "",
                    "http_path" => "*"
                ],
                [
                    "name" => "Dashboard",
                    "slug" => "dashboard",
                    "http_method" => "GET",
                    "http_path" => "/"
                ],
                [
                    "name" => "Login",
                    "slug" => "auth.login",
                    "http_method" => "",
                    "http_path" => "/auth/login\r\n/auth/logout"
                ],
                [
                    "name" => "User setting",
                    "slug" => "auth.setting",
                    "http_method" => "GET,PUT",
                    "http_path" => "/auth/setting"
                ],
                [
                    "name" => "Auth management",
                    "slug" => "auth.management",
                    "http_method" => "",
                    "http_path" => "/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs"
                ],
                [
                    "name" => "Boxes",
                    "slug" => "boxes",
                    "http_method" => "",
                    "http_path" => "/boxes"
                ],
                [
                    "name" => "Users",
                    "slug" => "users",
                    "http_method" => "",
                    "http_path" => "/users"
                ],
                [
                    "name" => "Addresses",
                    "slug" => "addresses",
                    "http_method" => "",
                    "http_path" => "/addresses"
                ],
                [
                    "name" => "Orders",
                    "slug" => "orders",
                    "http_method" => "",
                    "http_path" => "/orders"
                ],
                [
                    "name" => "Reviews",
                    "slug" => "reviews",
                    "http_method" => "",
                    "http_path" => "/reviews"
                ]
            ]
        );

        \Encore\Admin\Auth\Database\Role::truncate();
        \Encore\Admin\Auth\Database\Role::insert(
            [
                [
                    "name" => "Administrator",
                    "slug" => "administrator"
                ],
                [
                    "name" => "Vendor",
                    "slug" => "vendor"
                ]
            ]
        );

        // pivot tables
        DB::table('admin_role_menu')->truncate();
        DB::table('admin_role_menu')->insert(
            [
                [
                    "role_id" => 1,
                    "menu_id" => 2
                ]
            ]
        );

        DB::table('admin_role_permissions')->truncate();
        DB::table('admin_role_permissions')->insert(
            [
                [
                    "role_id" => 1,
                    "permission_id" => 1
                ],
                [
                    "role_id" => 2,
                    "permission_id" => 2
                ],
                [
                    "role_id" => 2,
                    "permission_id" => 3
                ],
                [
                    "role_id" => 2,
                    "permission_id" => 7
                ],
                [
                    "role_id" => 2,
                    "permission_id" => 8
                ],
                [
                    "role_id" => 2,
                    "permission_id" => 9
                ],
                [
                    "role_id" => 2,
                    "permission_id" => 10
                ]
            ]
        );

        // finish
    }
}
