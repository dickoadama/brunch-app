<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Categorie;

class MenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Récupérer ou créer une catégorie par défaut
        $categorie = Categorie::firstOrCreate([
            'nom' => 'Divers'
        ], [
            'description' => 'Menus divers',
            'type' => 'divers'
        ]);
        
        // Créer des menus avec les montants spécifiés
        $menus = [
            [
                'nom' => 'Menu Économique',
                'description' => 'Menu de 2500 FCFA - Offre économique',
                'date_menu' => now(),
                'prix' => 2500,
                'type' => 'divers',
                'categorie_id' => $categorie->id
            ],
            [
                'nom' => 'Menu Léger',
                'description' => 'Menu de 5000 FCFA - Repas léger',
                'date_menu' => now(),
                'prix' => 5000,
                'type' => 'divers',
                'categorie_id' => $categorie->id
            ],
            [
                'nom' => 'Menu Standard',
                'description' => 'Menu de 7000 FCFA - Repas complet',
                'date_menu' => now(),
                'prix' => 7000,
                'type' => 'divers',
                'categorie_id' => $categorie->id
            ],
            [
                'nom' => 'Menu Premium',
                'description' => 'Menu de 10000 FCFA - Repas premium',
                'date_menu' => now(),
                'prix' => 10000,
                'type' => 'divers',
                'categorie_id' => $categorie->id
            ],
            [
                'nom' => 'Menu Gourmet',
                'description' => 'Menu de 15000 FCFA - Repas gourmet',
                'date_menu' => now(),
                'prix' => 15000,
                'type' => 'divers',
                'categorie_id' => $categorie->id
            ],
            [
                'nom' => 'Menu VIP',
                'description' => 'Menu de 20000 FCFA - Repas VIP',
                'date_menu' => now(),
                'prix' => 20000,
                'type' => 'divers',
                'categorie_id' => $categorie->id
            ]
        ];
        
        foreach ($menus as $menuData) {
            Menu::firstOrCreate(
                ['nom' => $menuData['nom']],
                $menuData
            );
        }
        
        $this->command->info('Menus créés avec succès !');
    }
}