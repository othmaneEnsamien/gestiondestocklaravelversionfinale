<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Client;
use App\Models\Commande;
use App\Models\Produit;
use App\Models\SubCategory;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function create()
    {
        $totals = $this->getTotalProduitsCommandes();
        $commandes = Commande::all();
        $categories = Category::all();
        $clients = Client::all();

        return view('admin.commandes.commande', compact('commandes', 'categories', 'clients', 'totals'));
    }

    public function getSubCategories($categorieId)
    {
        $sousCategories = SubCategory::where('id_categorie', $categorieId)->get();
        return response()->json($sousCategories);
    }

    public function getProducts($subCategorieId)
    {
        $produits = Produit::where('id_souscategorie', $subCategorieId)->get();
        return response()->json($produits);
    }

    public function getProductQuantity($produitId)
    {
        $produit = Produit::findOrFail($produitId);
        $quantity = $produit->mesure;

        return response()->json(['product' => $produit->nomproduit, 'quantity' => $quantity]);
    }

    // public function getTotalProduitsCommandes()
    // {
    //     // Récupérez toutes les commandes avec leurs produits associés et les quantités commandées
    //     $commandes = Commande::with('produits')->get();

    //     // Tableau pour stocker les totaux de chaque commande
    //     $totals = [];

    //     foreach ($commandes as $commande) {
    //         $totalCommande = 0;

    //         // Parcourez les produits associés à la commande et calculez le total pour cette commande
    //         foreach ($commande->produits as $produit) {
    //             // Assurez-vous que la relation entre les commandes et les produits est correctement configurée
    //             // Ici, j'utilise une méthode hypothétique "pivotQuantity" pour récupérer la quantité commandée du produit
    //             // Vous devrez ajuster cette partie en fonction de votre modèle de données
    //             $quantiteCommandee = $produit->pivotQuantity();

    //             // Calculer le total pour ce produit en multipliant le prix par la quantité commandée
    //             $totalProduit = $produit->prix * $quantiteCommandee;

    //             // Ajouter le total de ce produit au total de la commande
    //             $totalCommande += $totalProduit;
    //         }

    //         // Ajoutez le total de cette commande au tableau des totaux
    //         $totals[$commande->id] = $totalCommande;
    //     }

    //     return $totals;
    // }
    public function getTotalProduitsCommandes()
    {
        // Récupérez toutes les commandes avec leurs produits associés et les quantités commandées
        $commandes = Commande::with('produits')->get();

        // Tableau pour stocker les totaux de chaque commande
        $totals = [];

        foreach ($commandes as $commande) {
            $totalCommande = 0;

            // Parcourez les produits associés à la commande et calculez le total pour cette commande
            foreach ($commande->produits as $produit) {
                // Accédez à la quantité commandée directement à partir de la relation
                $quantiteCommandee = $produit->pivot->quantite;

                // Calculer le total pour ce produit en multipliant le prix par la quantité commandée
                $totalProduit = $produit->Prix * $quantiteCommandee;

                // Ajouter le total de ce produit au total de la commande
                $totalCommande += $totalProduit;
            }

            // Ajoutez le total de cette commande au tableau des totaux
            $totals[$commande->id] = $totalCommande;
        }

        return $totals;
    }
    public function addCommande(Request $request)
    {
        // Récupérez les données du client à partir de la requête
        $typeCommande = $request->input('type_commande');
        $etat = 'En attente'; // Par défaut, l'état est défini sur "En attente"
        $numeroCommande = 'CMD-' . uniqid();
        $typeClient = $request->input('type_client');

        if ($typeClient === 'existant') {
            // Récupérer l'ID du client existant sélectionné
            $clientID = $request->input('client_existant');
        } else if ($typeClient === 'nouveau') {
            // Créez un nouvel enregistrement dans la table clients pour stocker les informations du nouveau client
            $client = new Client();
            $client->nomclient = $request->input('nomclient');
            $client->telephone = $request->input('telephone');
            $client->save();

            // Récupérez l'ID du client nouvellement créé
            $clientID = $client->id;
        } else {
            return redirect()->back()->with('error', 'Veuillez sélectionner le type de client.');
        }

        // Créez un nouvel enregistrement dans la table commandes pour stocker les informations de la commande associée
        $commande = new Commande();
        $commande->client_id = $clientID; // Associez la commande au client en utilisant l'ID du client
        $commande->type_commande = $typeCommande;
        $commande->etat = $etat;
        $commande->numero_commande = $numeroCommande;
        $commande->save();

        // Récupérez l'ID de la commande nouvellement créée
        $commandeID = $commande->id;

        // Récupérez les informations des produits sélectionnés et les quantités associées
        $produitsIds = $request->input('listProduct');
        $quantites = $request->input('quantite');

        // Vérifiez si les tableaux de produits et de quantités ont la même taille
        if (count($produitsIds) !== count($quantites)) {
            return redirect()->back()->with('error', 'Les produits et les quantités ne correspondent pas.');
        }

        $invalidQuantities = [];

        for ($i = 0; $i < count($produitsIds); $i++) {
            $produitId = $produitsIds[$i];
            $quantite = $quantites[$i];

            $produit = Produit::find($produitId);

            if ($produit) {
                $quantiteDisponible = $produit->mesure;

                // Vérifiez si la quantité saisie est supérieure à la quantité disponible
                if ($quantite > $quantiteDisponible) {
                    // Ajoutez l'ID du produit à la liste des quantités invalides
                    $invalidQuantities[] = $produitId;
                } else {
                    // Ajoutez la relation entre la commande et le produit avec la quantité associée
                    $commande->produits()->attach($produitId, ['quantite' => $quantite]);
                    // Mettez à jour la quantité disponible du produit en soustrayant la quantité commandée
                    $produit->mesure -= $quantite;
                    $produit->save();
                }
            } else {
                return redirect()->back()->with('error', 'Produit non trouvé.');
            }
        }

        // Vérifiez s'il y a des quantités invalides, si oui, supprimez la commande et les associations avec les produits
        if (!empty($invalidQuantities)) {
            // Supprimez la commande et les associations avec les produits
            $commande->produits()->detach($invalidQuantities);
            $commande->delete();

            // Redirigez l'utilisateur avec un message d'erreur
            return redirect()->back()->with('error', 'La quantité saisie dépasse la quantité disponible pour certains produits. La commande a été supprimée.');
        }

        // Retournez une réponse indiquant que la commande a été ajoutée avec succès
        return redirect()->back()->with('success', 'La commande a été ajoutée avec succès.');
    }

    public function showDetail($id)
    {
        // Récupérer la commande avec l'ID spécifié
        $commande = Commande::findOrFail($id);

        // Récupérer les produits de la commande
        $produits = $commande->produits;

        // Retourner la vue 'commande.blade.php' avec les détails de la commande et les produits
        return view('admin.commandes.commande', compact('commande', 'produits'));
    }
    public function updateEtat(Request $request)
    {
        $commandeId = $request->input('commandeId');

        // Recherchez la commande par son ID
        $commande = Commande::find($commandeId);

        if (!$commande) {
            // Gérez le cas où la commande n'est pas trouvée
            return response()->json(['success' => false, 'message' => 'Commande introuvable']);
        }

        // Mettez à jour l'état de la commande
        $commande->etat = 'livre';
        $commande->save();



        return response()->json(['success' => true, 'message' => 'État de la commande mis à jour']);
    }
}