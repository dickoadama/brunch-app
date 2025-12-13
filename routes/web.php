<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\BoutiqueController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Routes pour le tableau de bord et les statistiques
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');

Route::get('/statistiques/ventes', function () {
    return view('statistiques.ventes');
})->name('statistiques.ventes');

Route::get('/statistiques/clients', function () {
    return view('statistiques.clients');
})->name('statistiques.clients');

Route::get('/statistiques/reservations', function () {
    return view('statistiques.reservations');
})->name('statistiques.reservations');


// Routes pour les clients
Route::resource('clients', ClientController::class);

// Routes pour les menus
Route::resource('menus', MenuController::class);

// Routes pour les commandes
Route::resource('commandes', CommandeController::class);
Route::get('commandes/{commande}/payer', [CommandeController::class, 'payer'])->name('commandes.payer');
Route::post('commandes/{commande}/traiter-paiement', [CommandeController::class, 'traiterPaiement'])->name('commandes.traiterPaiement');
Route::get('commandes-liste-predifinie', function () {
    return view('commandes.liste_predifinie');
})->name('commandes.liste_predifinie');


// Routes pour les catégories
Route::resource('categories', CategorieController::class);

// Routes pour les fournisseurs
Route::resource('fournisseurs', FournisseurController::class);

// Routes pour les employés
Route::resource('employes', EmployeController::class);

// Routes pour les réservations
Route::resource('reservations', ReservationController::class);
Route::get('reservations/{reservation}/payer', [ReservationController::class, 'payer'])->name('reservations.payer');
Route::post('reservations/{reservation}/traiter-paiement', [ReservationController::class, 'traiterPaiement'])->name('reservations.traiterPaiement');

// Routes pour les tables
Route::resource('tables', TableController::class);

// Routes pour les tickets
Route::resource('tickets', TicketController::class);
Route::get('tickets/{ticket}/acheter', [TicketController::class, 'acheter'])->name('tickets.acheter');

// Routes pour les paiements
Route::resource('paiements', PaiementController::class);
Route::post('paiements/{paiement}/generer-qrcode', [PaiementController::class, 'genererQrCode'])->name('paiements.genererQrCode');

// Routes pour le panier
Route::get('/panier', [PanierController::class, 'index'])->name('panier.index');
Route::post('/panier/ajouter/{type}/{id}', [PanierController::class, 'ajouter'])->name('panier.ajouter');
Route::put('/panier/mettre-a-jour/{itemId}', [PanierController::class, 'mettreAJour'])->name('panier.mettreAJour');
Route::delete('/panier/supprimer/{itemId}', [PanierController::class, 'supprimer'])->name('panier.supprimer');
Route::delete('/panier/vider', [PanierController::class, 'vider'])->name('panier.vider');
Route::get('/panier/count', [PanierController::class, 'getCount'])->name('panier.count');

// Route pour la boutique
Route::get('/boutique', [BoutiqueController::class, 'index'])->name('boutique.index');

// Routes pour les pages supplémentaires
Route::get('/contacts', function () {
    return view('contacts.index');
})->name('contacts.index');

Route::get('/parametres', function () {
    return view('parametres.index');
})->name('parametres.index');

Route::get('/aides', function () {
    return view('aides.index');
})->name('aides.index');