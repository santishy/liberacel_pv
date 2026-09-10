<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RafflePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();
        $permissions = [
            'create raffle',
            'view raffle',
            'view raffles',
            'edit raffle',
            'delete raffle',
            // permissions to raffle numbers
            'view raffle numbers',
            'view raffle number',
            'assign raffle number',
            'update raffle number',
            'release raffle number',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission);
        }
    }
}
