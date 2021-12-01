<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::truncate();
        // permissions to products
        Permission::create(['name' => 'create product']);
        Permission::create(['name' => 'view product']);
        Permission::create(['name' => 'delete product']);
        Permission::create(['name' => 'edit product']);

        // permissions to users
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'delete user']);
        Permission::create(['name' => 'edit user']);

        // permissions to purchases
        Permission::create(['name' => 'create purchase']);
        Permission::create(['name' => 'view purchase']);
        Permission::create(['name' => 'view purchases']);
        Permission::create(['name' => 'delete purchase']);
        Permission::create(['name' => 'edit purchase']);

        // permissions to sales
        Permission::create(['name' => 'create sale']);
        Permission::create(['name' => 'view sale']);
        Permission::create(['name' => 'view sales']);
        Permission::create(['name' => 'delete sale']);
        Permission::create(['name' => 'edit sale']);

        // permissions to clients
        Permission::create(['name' => 'create client']);
        Permission::create(['name' => 'view client']);
        Permission::create(['name' => 'view clients']);
        Permission::create(['name' => 'delete client']);
        Permission::create(['name' => 'edit client']);

        // permissions to categories
        Permission::create(['name' => 'create category']);
        Permission::create(['name' => 'view category']);
        Permission::create(['name' => 'delete category']);

        //permissions to warehouses
        Permission::create(['name' => 'create warehouse']);
        Permission::create(['name' => 'view warehouse']);
        Permission::create(['name' => 'view warehouses']);
        Permission::create(['name' => 'delete warehouse']);
        Permission::create(['name' => 'edit warehouse']);

        Permission::create(['name' => 'edit stock']);
        Permission::create(['name' => 'empty stock']);
        Permission::create(['name' => 'view stock']);

        //permissions to roles
        Permission::create(['name' => 'create role']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'view role']);
        Permission::create(['name' => 'delete role']);
        Permission::create(['name' => 'edit role']);

        //permissions to ticket
        Permission::create(['name' => 'edit ticket']);
    }
}
