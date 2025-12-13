<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\Menu;
use App\Models\Table;
use App\Models\Categorie;

class TicketsMenusTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Créer des catégories si elles n'existent pas
        $categorieBrunch = Categorie::firstOrCreate([
            'nom' => 'Brunch'
        ], [
            'description' => 'Menus de brunch',
            'type' => 'brunch'
        ]);
        
        $categorieDejeuner = Categorie::firstOrCreate([
            'nom' => 'Déjeuner'
        ], [
            'description' => 'Menus de déjeuner',
            'type' => 'dejeuner'
        ]);
        
        $categorieDiner = Categorie::firstOrCreate([
            'nom' => 'Dîner'
        ], [
            'description' => 'Menus de dîner',
            'type' => 'diner'
        ]);
        
        // Créer les tickets avec les valeurs spécifiées
        $tickets = [
            [
                'nom' => 'Ticket 5000 FCFA',
                'prix' => 5000,
                'description' => 'Ticket de 5000 FCFA pour vos achats',
                'actif' => true
            ],
            [
                'nom' => 'Ticket 10000 FCFA',
                'prix' => 10000,
                'description' => 'Ticket de 10000 FCFA pour vos achats',
                'actif' => true
            ],
            [
                'nom' => 'Ticket 20000 FCFA',
                'prix' => 20000,
                'description' => 'Ticket de 20000 FCFA pour vos achats',
                'actif' => true
            ],
            [
                'nom' => 'Ticket 30000 FCFA',
                'prix' => 30000,
                'description' => 'Ticket de 30000 FCFA pour vos achats',
                'actif' => true
            ],
            [
                'nom' => 'Ticket 40000 FCFA',
                'prix' => 40000,
                'description' => 'Ticket de 40000 FCFA pour vos achats',
                'actif' => true
            ],
            [
                'nom' => 'Ticket 50000 FCFA',
                'prix' => 50000,
                'description' => 'Ticket de 50000 FCFA pour vos achats',
                'actif' => true
            ]
        ];
        
        foreach ($tickets as $ticketData) {
            Ticket::firstOrCreate(
                ['nom' => $ticketData['nom']],
                $ticketData
            );
        }
        
        // Créer des menus de démonstration
        $menus = [
            [
                'nom' => 'Brunch Complet',
                'description' => 'Assortiment de pains, viennoiseries, œufs, fruits, yaourt et boissons',
                'date_menu' => now(),
                'prix' => 7500,
                'type' => 'brunch',
                'categorie_id' => $categorieBrunch->id
            ],
            [
                'nom' => 'Brunch Léger',
                'description' => 'Croissants, tartines, fruits frais et café',
                'date_menu' => now(),
                'prix' => 5000,
                'type' => 'brunch',
                'categorie_id' => $categorieBrunch->id
            ],
            [
                'nom' => 'Menu Déjeuner Executive',
                'description' => 'Entrée, plat principal, dessert et boisson',
                'date_menu' => now(),
                'prix' => 12000,
                'type' => 'dejeuner',
                'categorie_id' => $categorieDejeuner->id
            ],
            [
                'nom' => 'Menu Déjeuner Simple',
                'description' => 'Plat principal et boisson',
                'date_menu' => now(),
                'prix' => 8000,
                'type' => 'dejeuner',
                'categorie_id' => $categorieDejeuner->id
            ],
            [
                'nom' => 'Menu Dîner Gourmet',
                'description' => 'Entrée, plat principal, dessert, vin et café',
                'date_menu' => now(),
                'prix' => 15000,
                'type' => 'diner',
                'categorie_id' => $categorieDiner->id
            ]
        ];
        
        foreach ($menus as $menuData) {
            Menu::firstOrCreate(
                ['nom' => $menuData['nom']],
                $menuData
            );
        }
        
        // Créer des tables de démonstration
        $tables = [
            [
                'numero_table' => 1,
                'capacite' => 2,
                'emplacement' => 'Terrasse',
                'statut' => 'disponible'
            ],
            [
                'numero_table' => 2,
                'capacite' => 4,
                'emplacement' => 'Intérieur',
                'statut' => 'disponible'
            ],
            [
                'numero_table' => 3,
                'capacite' => 6,
                'emplacement' => 'Terrasse',
                'statut' => 'disponible'
            ],
            [
                'numero_table' => 4,
                'capacite' => 2,
                'emplacement' => 'Intérieur',
                'statut' => 'disponible'
            ],
            [
                'numero_table' => 5,
                'capacite' => 8,
                'emplacement' => 'Salle privée',
                'statut' => 'disponible'
            ]
        ];
        
        foreach ($tables as $tableData) {
            Table::firstOrCreate(
                ['numero_table' => $tableData['numero_table']],
                $tableData
            );
        }
        
        $this->command->info('Tickets, menus et tables créés avec succès !');
    }
}