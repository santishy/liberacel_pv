<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->delete();
        Permission::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

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

        //permissions to fast sale
        Permission::create(['name' => 'create fast sale']);
        Permission::create(['name' => 'view fast sale']);
        Permission::create(['name' => 'view fast sales']);
        Permission::create(['name' => 'edit fast sale']);
        Permission::create(['name' => 'delete fast sale product']);
        Permission::create(['name' => 'cancel fast sale']);

        //permissions to commissions
        Permission::create(['name' => 'view user commissions']);
        Permission::create(['name' => 'edit user commission']);

        //permissions to expenses
        Permission::create(['name' => 'create expense']);
        Permission::create(['name' => 'view expense']);
        Permission::create(['name' => 'view expenses']);
        Permission::create(['name' => 'edit expense']);
        Permission::create(['name' => 'delete expense']);

        //permissions to payments
        Permission::create(['name' => 'create payment']);
        Permission::create(['name' => 'view payment']);
        Permission::create(['name' => 'view payments']);
        Permission::create(['name' => 'edit payment']);
        Permission::create(['name' => 'delete payment']);

        //permissions to credits
        Permission::create(['name' => 'create credit']);
        Permission::create(['name' => 'view credit']);
        Permission::create(['name' => 'view credits']);
        Permission::create(['name' => 'edit credit']);
        Permission::create(['name' => 'delete credit']);

        //permissions to checkout
        Permission::create(["name" => 'complete sales checkout']);
    }
}
