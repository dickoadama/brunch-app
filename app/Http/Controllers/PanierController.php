<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Menu;
use App\Models\Table;
use Illuminate\Support\Facades\Session;

class PanierController extends Controller
{
    /**
     * Afficher le panier
     */
    public function index()
    {
        $panier = Session::get('panier', []);
        $total = 0;
        
        // Calculer le total
        foreach ($panier as $item) {
            $total += $item['prix'] * $item['quantite'];
        }
        
        return view('panier.index', compact('panier', 'total'));
    }
    
    /**
     * Obtenir le nombre d'articles dans le panier
     */
    public function getCount()
    {
        $panier = Session::get('panier', []);
        $totalCount = 0;
        
        foreach ($panier as $item) {
            $totalCount += $item['quantite'];
        }
        
        return response()->json(['count' => $totalCount]);
    }
    
    /**
     * Ajouter un élément au panier
     */
    public function ajouter(Request $request, $type, $id)
    {
        // Vérifier que les paramètres sont présents
        if (!$type || !$id) {
            return redirect()->back()->with('error', 'Paramètres invalides!');
        }
        
        $panier = Session::get('panier', []);
        
        // Récupérer l'élément en fonction du type
        $item = null;
        $itemName = '';
        $itemPrice = 0;
        
        switch ($type) {
            case 'ticket':
                $ticket = Ticket::find($id);
                if ($ticket) {
                    $item = $ticket;
                    $itemName = $ticket->nom;
                    $itemPrice = $ticket->prix;
                }
                break;
                
            case 'menu':
                $menu = Menu::find($id);
                if ($menu) {
                    $item = $menu;
                    $itemName = $menu->nom;
                    $itemPrice = $menu->prix;
                }
                break;
                
            case 'table':
                $table = Table::find($id);
                if ($table) {
                    $item = $table;
                    $itemName = 'Table #' . $table->numero;
                    
                    // Extraire le prix à partir de la description
                    if (preg_match('/(\d+)/', $table->description, $matches)) {
                        $itemPrice = (int)$matches[0];
                    } else {
                        $itemPrice = 0;
                    }
                }
                break;
                
            default:
                return redirect()->back()->with('error', 'Type d\'élément invalide!');
        }
        
        if (!$item) {
            return redirect()->back()->with('error', 'Élément non trouvé!');
        }
        
        $itemId = $type . '_' . $id;
        
        // Vérifier si l'élément est déjà dans le panier
        if (isset($panier[$itemId])) {
            // Incrémenter la quantité
            $panier[$itemId]['quantite']++;
        } else {
            // Ajouter l'élément au panier
            $panier[$itemId] = [
                'id' => $itemId,
                'type' => $type,
                'element_id' => $id,
                'nom' => $itemName,
                'prix' => $itemPrice,
                'quantite' => 1
            ];
        }
        
        Session::put('panier', $panier);
        
        return redirect()->back()->with('success', 'Élément ajouté au panier avec succès!');
    }
    
    /**
     * Mettre à jour la quantité d'un élément dans le panier
     */
    public function mettreAJour(Request $request, $itemId)
    {
        $panier = Session::get('panier', []);
        
        if (isset($panier[$itemId])) {
            $quantite = $request->input('quantite', 1);
            
            if ($quantite <= 0) {
                // Supprimer l'item si la quantité est 0 ou négative
                unset($panier[$itemId]);
            } else {
                // Mettre à jour la quantité
                $panier[$itemId]['quantite'] = $quantite;
            }
            
            Session::put('panier', $panier);
        }
        
        return redirect()->back()->with('success', 'Panier mis à jour avec succès!');
    }
    
    /**
     * Supprimer un élément du panier
     */
    public function supprimer($itemId)
    {
        $panier = Session::get('panier', []);
        
        if (isset($panier[$itemId])) {
            unset($panier[$itemId]);
            Session::put('panier', $panier);
        }
        
        return redirect()->back()->with('success', 'Élément supprimé du panier avec succès!');
    }
    
    /**
     * Vider le panier
     */
    public function vider()
    {
        Session::forget('panier');
        
        return redirect()->back()->with('success', 'Panier vidé avec succès!');
    }
}