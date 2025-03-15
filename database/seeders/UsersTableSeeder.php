<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'phone' => '+212678420419',
            'address' => '6 lot mimoza ahadaf azrou',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create some test clients
        $clients = [
            [
                'name' => 'Client 1',
                'email' => 'client1@example.com',
                'phone' => '0123456789',
                'address' => 'Address for client 1',
            ],
            [
                'name' => 'Client 2',
                'email' => 'client2@example.com',
                'phone' => '0123456789',
                'address' => 'Address for client 2',
            ],
            [
                'name' => 'YOUSSEF GUEROUAT',
                'email' => 'grouateyoussef0@gmail.com',
                'phone' => '+212678420419',
                'address' => '6 lot mimoza ahadaf azrou',
            ],
        ];

        foreach ($clients as $client) {
            User::create([
                'name' => $client['name'],
                'email' => $client['email'],
                'phone' => $client['phone'],
                'address' => $client['address'],
                'password' => Hash::make('password'),
                'role' => 'client',
            ]);
        }
    }
} 