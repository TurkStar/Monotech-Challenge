<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        \App\Models\User::create([
            'username' => 'behzat123',
            'firstname' => 'Behzat',
            'lastname' => 'Cozer',
            'email' => 'behzat.php@gmail.com'
        ]);
        
        \App\Models\User::create([
            'username' => 'serkan123',
            'firstname' => 'Serkan',
            'lastname' => 'Akgül',
            'email' => 'serkan.php@gmail.com'
        ]);
    }
}
