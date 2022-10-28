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
        //User::truncate();
        //Role::truncate();
        //Ticket::truncate();
        // Inventory::truncate();
        // Inventory::factory()->create();
        //Ticket::factory()->create();
        $adminRole = Role::where('name','admin');
        if(!$adminRole->exists())
            $adminRole = Role::create(['name' => 'admin']);
        else
            $adminRole = $adminRole->first();

        $user = new User;
        $user->email = 'admin@saeseg.app';
        $user->name = 'Santiago Martín OE';
        $user->username = 'admin';
        $user->password = 'san10mar';//bcrypt('san10mar');
        $user->inventory_id = null;
        $user->save();
        $user->assignRole($adminRole);
    }
}
