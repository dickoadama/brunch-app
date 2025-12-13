<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Table;

class TablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Créer des tables avec les montants spécifiés
        $tables = [
            [
                'numero_table' => 101,
                'capacite' => 2,
                'emplacement' => 'Terrasse',
                'statut' => 'disponible',
                'description' => 'Table de 5000 FCFA - Pour 2 personnes'
            ],
            [
                'numero_table' => 102,
                'capacite' => 4,
                'emplacement' => 'Intérieur',
                'statut' => 'disponible',
                'description' => 'Table de 10000 FCFA - Pour 4 personnes'
            ],
            [
                'numero_table' => 103,
                'capacite' => 4,
                'emplacement' => 'Terrasse',
                'statut' => 'disponible',
                'description' => 'Table de 15000 FCFA - Pour 4 personnes'
            ],
            [
                'numero_table' => 104,
                'capacite' => 6,
                'emplacement' => 'Intérieur',
                'statut' => 'disponible',
                'description' => 'Table de 20000 FCFA - Pour 6 personnes'
            ],
            [
                'numero_table' => 105,
                'capacite' => 6,
                'emplacement' => 'Terrasse',
                'statut' => 'disponible',
                'description' => 'Table de 25000 FCFA - Pour 6 personnes'
            ],
            [
                'numero_table' => 106,
                'capacite' => 8,
                'emplacement' => 'Intérieur',
                'statut' => 'disponible',
                'description' => 'Table de 30000 FCFA - Pour 8 personnes'
            ],
            [
                'numero_table' => 107,
                'capacite' => 8,
                'emplacement' => 'Terrasse',
                'statut' => 'disponible',
                'description' => 'Table de 35000 FCFA - Pour 8 personnes'
            ],
            [
                'numero_table' => 108,
                'capacite' => 10,
                'emplacement' => 'Salle privée',
                'statut' => 'disponible',
                'description' => 'Table de 40000 FCFA - Pour 10 personnes'
            ],
            [
                'numero_table' => 109,
                'capacite' => 12,
                'emplacement' => 'Salle privée',
                'statut' => 'disponible',
                'description' => 'Table de 45000 FCFA - Pour 12 personnes'
            ]
        ];
        
        foreach ($tables as $tableData) {
            Table::firstOrCreate(
                ['numero_table' => $tableData['numero_table']],
                $tableData
            );
        }
        
        $this->command->info('Tables créées avec succès !');
    }
}