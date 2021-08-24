<?php

namespace Database\Seeders;
use App\Models\Users_new;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Users_new::create([
            'firstname' => 'Admin',
            'lastname'=>'Admin',
            'contact'=>'9945618360',
            'active'=>1,
            'email' => 'admin@test.com',
            'password' => Hash::make('admin1010'),
            'role' => 1,
            'address'=>'world'
        ]);

        Users_new::create([
            'firstname' => 'Varunendra',
            'lastname'=>'B',
            'contact'=>'8150892426',
            'active'=>1,
            'email' => 'varuna3656@test.com',
            'password' => Hash::make('appuvaru'),
            'role' => 2,
            'address'=>'Kolacchavu Laila'
        ]);
    }
}
