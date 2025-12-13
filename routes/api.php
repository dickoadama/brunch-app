<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\ClientController;
use App\Http\Controllers\Api\V1\MenuController;
use App\Http\Controllers\Api\V1\CommandeController;
use App\Http\Controllers\Api\V1\TableController;
use App\Http\Controllers\Api\V1\ReservationController;
use App\Http\Controllers\Api\V1\PaiementController;
use App\Http\Controllers\Api\V1\PanierController;
use App\Http\Controllers\Api\V1\StatistiqueController;
use App\Http\Controllers\Api\V1\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Routes publiques
Route::prefix('v1')->group(function () {
    // Authentification
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    
    // Clients
    Route::apiResource('clients', ClientController::class);
    
    // Menus
    Route::apiResource('menus', MenuController::class);
    Route::get('menus/category/{categoryId}', [MenuController::class, 'byCategory']);
    
    // Commandes
    Route::apiResource('commandes', CommandeController::class);
    Route::get('commandes/client/{clientId}', [CommandeController::class, 'byClient']);
    Route::get('commandes/menu/{menuId}', [CommandeController::class, 'byMenu']);
    
    // Tables
    Route::apiResource('tables', TableController::class);
    Route::get('tables/available', [TableController::class, 'available']);
    
    // Réservations
    Route::apiResource('reservations', ReservationController::class);
    Route::get('reservations/client/{clientId}', [ReservationController::class, 'byClient']);
    Route::get('reservations/table/{tableId}', [ReservationController::class, 'byTable']);
    
    // Paiements
    Route::apiResource('paiements', PaiementController::class);
    Route::get('paiements/status/{status}', [PaiementController::class, 'byStatus']);
    
    // Panier
    Route::prefix('panier')->group(function () {
        Route::get('/', [PanierController::class, 'index']);
        Route::post('/', [PanierController::class, 'store']);
        Route::put('/{itemId}', [PanierController::class, 'update']);
        Route::delete('/{itemId}', [PanierController::class, 'destroy']);
        Route::delete('/clear', [PanierController::class, 'clear']);
    });
    
    // Statistiques
    Route::prefix('stats')->group(function () {
        Route::get('/dashboard', [StatistiqueController::class, 'dashboard']);
        Route::get('/ventes', [StatistiqueController::class, 'ventes']);
        Route::get('/clients', [StatistiqueController::class, 'clients']);
        Route::get('/reservations', [StatistiqueController::class, 'reservations']);
    });
});

// Routes protégées
Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});