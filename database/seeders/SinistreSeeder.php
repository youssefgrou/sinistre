<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Sinistre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SinistreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all client users
        $clients = User::where('role', 'client')->get();

        // Types of claims
        $typesSinistres = [
            'vol_tentative_vol',
            'vandalisme_degradations',
            'incendie_explosion',
            'bris_glaces',
            'collision_route'
        ];

        // Status options
        $statuses = ['en_attente', 'en_cours', 'expertise', 'validé', 'refusé'];

        // Car brands and models
        $voitures = [
            'Renault' => ['Clio', 'Megane', 'Captur', 'Scenic'],
            'Peugeot' => ['208', '308', '3008', '5008'],
            'Citroen' => ['C3', 'C4', 'C5', 'Berlingo'],
            'Volkswagen' => ['Golf', 'Polo', 'Tiguan', 'Passat'],
            'Toyota' => ['Yaris', 'Corolla', 'RAV4', 'CHR']
        ];

        // Create 3-5 claims for each client
        foreach ($clients as $client) {
            $nombreSinistres = rand(3, 5);
            
            for ($i = 0; $i < $nombreSinistres; $i++) {
                // Select random car brand and model
                $marque = array_rand($voitures);
                $modele = $voitures[$marque][array_rand($voitures[$marque])];

                // Generate random date within last 6 months
                $date = now()->subDays(rand(1, 180));

                // Get the latest sinistre number and increment it
                $latestSinistre = Sinistre::latest()->first();
                $latestNumber = $latestSinistre ? intval(substr($latestSinistre->numero_sinistre, 4)) : 0;
                $nextNumber = $latestNumber + 1;
                $numeroSinistre = 'SIN-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);

                // Create sinistre
                Sinistre::create([
                    'user_id' => $client->id,
                    'numero_sinistre' => $numeroSinistre,
                    'immatriculation' => rand(1, 9) . chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999),
                    'marque' => $marque,
                    'modele' => $modele,
                    'date_sinistre' => $date->format('Y-m-d'),
                    'heure_sinistre' => sprintf("%02d:%02d", rand(0, 23), rand(0, 59)),
                    'lieu_sinistre' => $this->getRandomAddress(),
                    'description' => $this->getRandomDescription(),
                    'circonstances' => $this->getRandomCircumstances(),
                    'type_sinistre' => $typesSinistres[array_rand($typesSinistres)],
                    'status' => $statuses[array_rand($statuses)],
                    'commentaire_admin' => null
                ]);
            }
        }
    }

    /**
     * Get a random French address
     */
    private function getRandomAddress(): string
    {
        $streets = [
            'Rue de la Paix',
            'Avenue des Champs-Élysées',
            'Boulevard Saint-Germain',
            'Rue du Commerce',
            'Avenue Victor Hugo',
            'Rue de la République',
            'Boulevard Haussmann'
        ];

        $cities = [
            '75001 Paris',
            '69001 Lyon',
            '13001 Marseille',
            '33000 Bordeaux',
            '31000 Toulouse',
            '44000 Nantes',
            '59000 Lille'
        ];

        return rand(1, 150) . ' ' . $streets[array_rand($streets)] . ', ' . $cities[array_rand($cities)];
    }

    /**
     * Get a random description for the damage
     */
    private function getRandomDescription(): string
    {
        $descriptions = [
            'Dommages importants sur le côté droit du véhicule suite à la collision.',
            'Pare-brise fissuré sur toute la largeur.',
            'Portière conducteur enfoncée et rayures profondes.',
            'Dégâts multiples sur la carrosserie et le pare-chocs avant.',
            'Vitre arrière brisée et serrure forcée.',
            'Traces de vandalisme sur l\'ensemble de la carrosserie.',
            'Impact important sur l\'aile avant gauche.'
        ];

        return $descriptions[array_rand($descriptions)];
    }

    /**
     * Get random circumstances for the incident
     */
    private function getRandomCircumstances(): string
    {
        $circumstances = [
            'Véhicule stationné sur un parking public quand l\'incident s\'est produit.',
            'Collision lors d\'une manœuvre de stationnement.',
            'Impact avec un objet sur la chaussée en circulation.',
            'Vandalisme constaté au réveil devant le domicile.',
            'Accident survenu lors d\'un dépassement sur voie rapide.',
            'Choc avec un autre véhicule à un carrefour.',
            'Dégâts constatés au retour des courses dans un centre commercial.'
        ];

        return $circumstances[array_rand($circumstances)];
    }
}
