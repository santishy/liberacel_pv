<?php

namespace Database\Seeders;

use App\Models\Inventory;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Role::truncate();
        Ticket::truncate();
        Inventory::truncate();
        Inventory::factory()->create();
        Ticket::factory()->create();
        $adminRole = Role::create(['name' => 'admin']);
        $user = new User;
        $user->email = 'santi_shy@hotmail.com';
        $user->name = 'Santiago Martín OE';
        $user->password = bcrypt('san10mar');
        $user->inventory_id = null;
        $user->save();
        $user->assignRole($adminRole);
    }
}
