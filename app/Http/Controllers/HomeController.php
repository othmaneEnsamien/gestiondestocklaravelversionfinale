<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Commande;
use App\Models\Facture;
use App\Models\Produit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ConsoleTVs\Charts\Facades\Charts;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function userRolesPermissionsChart()
    {
        $productsOutOfStock = Produit::where('mesure', '<=', 10)->paginate(3);
        $totalCommandes = Commande::count();
        $totalClients = Client::count();
        $newCommandesToday = Commande::whereDate('created_at', Carbon::today())->count();

        // Obtenez la date courante
        $dateCourante = Carbon::now();
        // Obtenez le mois de la date courante
        $moisCourant = $dateCourante->month;
        $revenuMensuelCourant = DB::table('command')
            ->select(DB::raw('SUM(produits.Prix * commande_produit.quantite) as montant_total, MONTH(command.created_at) as mois'))
            ->join('commande_produit', 'command.id', '=', 'commande_produit.commande_id')
            ->join('produits', 'commande_produit.produit_id', '=', 'produits.id')
            ->where('command.etat', 'livre')
            ->whereMonth('command.created_at', $moisCourant)
            ->groupBy(DB::raw('MONTH(command.created_at)'))
            ->get();
        $revenuMensuel = DB::table('command')
            ->select(DB::raw('SUM(produits.Prix * commande_produit.quantite) as montant_total, MONTH(command.created_at) as mois'))
            ->join('commande_produit', 'command.id', '=', 'commande_produit.commande_id')
            ->join('produits', 'commande_produit.produit_id', '=', 'produits.id')
            ->where('command.etat', 'livre')
            ->groupBy(DB::raw('MONTH(command.created_at)'))
            ->get();

        // Récupérer les 5 meilleurs clients
        $topClients = Client::withCount('commandes')
            ->orderByDesc('commandes_count')
            ->limit(5)
            ->get();

        // Récupérer les 5 meilleurs produits
        $topProducts = Produit::withCount('commandes')
            ->orderByDesc('commandes_count')
            ->limit(5)
            ->get();

        // Récupérer le total des dépenses payées pour les factures de produits (en prenant en compte les factures négatives)
        $expenses = DB::table('factureproduit')
            ->join('produits', 'factureproduit.ID_Produit', '=', 'produits.id')
            ->where('factureproduit.Quantite', '>', 0) // Uniquement les produits achetés (quantité > 0)
            ->sum(DB::raw('produits.Prix * factureproduit.Quantite'));

        $income = DB::table('command')
            ->join('commande_produit', 'command.id', '=', 'commande_produit.commande_id')
            ->join('produits', 'commande_produit.produit_id', '=', 'produits.id')
            ->where('command.etat', 'livre') // Uniquement les commandes livrées
            ->sum(DB::raw('produits.Prix * commande_produit.quantite'));

        $maxCommandes = max($topClients->pluck('commandes_count')->toArray());
        $maxCommandesProduits = max($topProducts->pluck('commandes_count')->toArray());

        // Nouvelle requête pour récupérer le nombre de commandes par jour
        $commandesParJour = Commande::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get();

        // Transformez les résultats en tableaux associatifs pour le graphique
        $labels = $commandesParJour->pluck('date')->toArray();
        $data = $commandesParJour->pluck('count')->toArray();

        $users = User::all();
        $rolesCount = [];
        $permissionsCount = [];

        foreach ($users as $user) {
            $rolesCount[$user->name] = $user->roles()->count();
            $permissionsCount[$user->name] = $user->getAllPermissions()->count();
        }


        return view('home', compact('expenses', 'revenuMensuelCourant', 'productsOutOfStock', 'income', 'topProducts', 'topClients', 'maxCommandesProduits', 'maxCommandes', 'rolesCount', 'permissionsCount', 'totalCommandes', 'totalClients', 'newCommandesToday', 'revenuMensuel', 'labels', 'data'));
    }
}
