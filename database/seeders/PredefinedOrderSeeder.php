<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Menu;
use App\Models\Categorie;
use App\Models\Table;
use App\Models\Commande;

class PredefinedOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Créer un client
        $client = Client::firstOrCreate([
            'email' => 'client@example.com'
        ], [
            'nom' => 'Dupont',
            'prenom' => 'Jean',
            'telephone' => '0123456789',
            'adresse' => '123 Rue Exemple, 75001 Paris'
        ]);

        // Créer des catégories
        $categoriePlats = Categorie::firstOrCreate([
            'nom' => 'Plats Principaux'
        ], [
            'description' => 'Nos plats principaux',
            'type' => 'menu'
        ]);

        $categorieDesserts = Categorie::firstOrCreate([
            'nom' => 'Desserts'
        ], [
            'description' => 'Nos desserts maison',
            'type' => 'menu'
        ]);

        // Créer un fournisseur
        $fournisseur = \App\Models\Fournisseur::firstOrCreate([
            'email' => 'fournisseur@example.com'
        ], [
            'nom' => 'Fournisseur Alimentaire',
            'contact' => 'Contact Principal',
            'telephone' => '0123456789',
            'adresse' => '456 Avenue des Fournisseurs, 75002 Paris',
            'specialite' => 'Produits alimentaires'
        ]);



        // Créer des menus
        $menuBrunch = Menu::firstOrCreate([
            'nom' => 'Brunch Complet'
        ], [
            'description' => 'Un brunch complet avec pancakes et dessert',
            'prix' => 15.50,
            'type' => 'standard',
            'categorie_id' => $categoriePlats->id
        ]);

        // Créer des tables
        $table1 = Table::firstOrCreate([
            'numero_table' => 'T001'
        ], [
            'capacite' => 4,
            'emplacement' => 'Terrasse',
            'statut' => 'libre'
        ]);

        $table2 = Table::firstOrCreate([
            'numero_table' => 'T002'
        ], [
            'capacite' => 2,
            'emplacement' => 'Intérieur',
            'statut' => 'libre'
        ]);

        // Créer une commande prédéfinie
        $commande = Commande::create([
            'client_id' => $client->id,
            'menu_id' => $menuBrunch->id,
            'date_commande' => now(),
            'nombre_personnes' => 2,
            'quantite' => 1,
            'montant_total' => $menuBrunch->prix,
            'statut' => 'confirmée',
            'commentaires' => 'Commande prédéfinie pour démonstration'
        ]);

        // Afficher un message de confirmation
        $this->command->info('Commande prédéfinie créée avec succès !');
        $this->command->info('Client: ' . $client->nom . ' ' . $client->prenom);
        $this->command->info('Menu: ' . $menuBrunch->nom . ' (' . $menuBrunch->prix . ' FCFA)');
        $this->command->info('Table: ' . $table1->numero_table);
        $this->command->info('Commande ID: ' . $commande->id);
    }
}
