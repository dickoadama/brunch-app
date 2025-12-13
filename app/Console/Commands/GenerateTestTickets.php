<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Ticket;

class GenerateTestTickets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tickets:generate-test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Génère des tickets de test avec des prix en FCFA';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Désactiver les contraintes de clé étrangère
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        
        // Supprimer les commandes existantes
        \App\Models\Commande::truncate();
        
        // Supprimer les réservations existantes
        \App\Models\Reservation::truncate();
        
        // Supprimer les paiements existants
        \App\Models\Paiement::truncate();
        
        // Supprimer les tickets existants
        Ticket::truncate();
        
        // Réactiver les contraintes de clé étrangère
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        
        // Créer des tickets de test
        $tickets = [
            [
                'nom' => 'Ticket 5000 FCFA',
                'prix' => 5000,
                'description' => 'Ticket pour petits achats',
                'actif' => true
            ],
            [
                'nom' => 'Ticket 10000 FCFA',
                'prix' => 10000,
                'description' => 'Ticket standard pour commandes moyennes',
                'actif' => true
            ],
            [
                'nom' => 'Ticket 15000 FCFA',
                'prix' => 15000,
                'description' => 'Ticket pour grandes commandes',
                'actif' => true
            ],
            [
                'nom' => 'Ticket 20000 FCFA',
                'prix' => 20000,
                'description' => 'Ticket premium pour événements spéciaux',
                'actif' => true
            ],
            [
                'nom' => 'Ticket 25000 FCFA',
                'prix' => 25000,
                'description' => 'Ticket VIP pour services exclusifs',
                'actif' => true
            ]
        ];
        
        foreach ($tickets as $ticketData) {
            Ticket::create($ticketData);
        }
        
        $this->info('Tickets de test générés avec succès !');
        
        return Command::SUCCESS;
    }
}
