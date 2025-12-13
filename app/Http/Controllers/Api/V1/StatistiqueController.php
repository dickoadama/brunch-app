<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Client;
use App\Models\Commande;
use App\Models\Reservation;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StatistiqueController extends ApiController
{
    /**
     * Get dashboard statistics
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function dashboard()
    {
        $stats = [
            'clients_count' => Client::count(),
            'commandes_count' => Commande::count(),
            'reservations_count' => Reservation::count(),
            'revenue_total' => Paiement::where('statut', 'complété')->sum('montant'),
            'recent_commandes' => Commande::with(['client', 'menu'])->latest()->take(5)->get(),
            'recent_reservations' => Reservation::with(['client', 'table'])->latest()->take(5)->get(),
        ];

        return $this->success($stats, 'Dashboard statistics retrieved successfully');
    }

    /**
     * Get sales statistics
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ventes(Request $request)
    {
        $period = $request->get('period', 'month');
        $startDate = $request->get('start_date', Carbon::now()->subMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->format('Y-m-d'));

        $query = Paiement::where('statut', 'complété')
            ->whereBetween('created_at', [$startDate, $endDate]);

        switch ($period) {
            case 'day':
                $sales = $query->selectRaw('DATE(created_at) as date, SUM(montant) as total')
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get();
                break;
            case 'week':
                $sales = $query->selectRaw('YEARWEEK(created_at) as week, SUM(montant) as total')
                    ->groupBy('week')
                    ->orderBy('week')
                    ->get();
                break;
            case 'month':
            default:
                $sales = $query->selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, SUM(montant) as total')
                    ->groupBy('month', 'year')
                    ->orderBy('year')
                    ->orderBy('month')
                    ->get();
                break;
        }

        return $this->success($sales, 'Sales statistics retrieved successfully');
    }

    /**
     * Get client statistics
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function clients()
    {
        $topClients = Client::withCount('commandes')
            ->orderBy('commandes_count', 'desc')
            ->take(10)
            ->get();

        $clientStats = [
            'total_clients' => Client::count(),
            'new_clients_this_month' => Client::where('created_at', '>=', Carbon::now()->startOfMonth())->count(),
            'top_clients' => $topClients
        ];

        return $this->success($clientStats, 'Client statistics retrieved successfully');
    }

    /**
     * Get reservation statistics
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function reservations()
    {
        $reservationStats = [
            'total_reservations' => Reservation::count(),
            'reservations_by_status' => Reservation::selectRaw('statut, count(*) as count')
                ->groupBy('statut')
                ->get(),
            'reservations_this_week' => Reservation::where('created_at', '>=', Carbon::now()->startOfWeek())->count()
        ];

        return $this->success($reservationStats, 'Reservation statistics retrieved successfully');
    }
}