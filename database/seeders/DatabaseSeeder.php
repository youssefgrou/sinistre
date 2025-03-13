<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Client;
use App\Models\Sinistre;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create some test clients
        for ($i = 1; $i <= 5; $i++) {
            $user = User::create([
                'name' => "Client $i",
                'email' => "client$i@example.com",
                'password' => Hash::make('password'),
                'role' => 'client',
            ]);

            $client = Client::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => '0123456789',
                'address' => "Address for client $i",
            ]);

            // Create some sinistres for each client
            $types = ['vol_tentative_vol', 'vandalisme_degradations', 'incendie_explosion', 'bris_glaces', 'collision_route'];
            $statuses = ['en_attente', 'en_cours', 'expertise', 'validé', 'refusé'];
            
            for ($j = 1; $j <= 2; $j++) {
                // Get the latest sinistre number and increment it
                $latestSinistre = Sinistre::latest()->first();
                $latestNumber = $latestSinistre ? intval(substr($latestSinistre->numero_sinistre, 4)) : 0;
                $nextNumber = $latestNumber + 1;
                $numeroSinistre = 'SIN-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);

                Sinistre::create([
                    'user_id' => $user->id,
                    'numero_sinistre' => $numeroSinistre,
                    'immatriculation' => "ABC{$i}{$j}123",
                    'marque' => 'Renault',
                    'modele' => 'Clio',
                    'date_sinistre' => now()->subDays(rand(1, 30)),
                    'heure_sinistre' => now()->format('H:i:s'),
                    'lieu_sinistre' => "Location $j",
                    'description' => "Sinistre $j for client $i",
                    'circonstances' => "Circumstances for sinistre $j",
                    'type_sinistre' => $types[array_rand($types)],
                    'status' => $statuses[array_rand($statuses)],
                    'commentaire_admin' => null,
                ]);
            }
        }
    }
}
