<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Facture;
use App\Models\Produit;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    public function create()
    {
        $factures = Facture::all();
        return view('admin.factures.factures', compact('factures'));
    }
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'fournisseur' => 'required',
            'numero_facture' => 'required|unique:factures,Num_Facture,NULL,id',
            'date_facture' => 'required|date',
            'prix_ht' => 'required|numeric',
            'tva' => 'required|numeric',
            'prix_ttc' => 'required|numeric',
        ]);

        // Préfixe "F" pour le numéro de facture
        $numeroFacture = 'F' . $request->input('numero_facture');

        // Créer une nouvelle instance de Facture
        $facture = new Facture();
        $facture->nomFournisseur = $request->input('fournisseur');
        $facture->Num_Facture = $numeroFacture;
        $facture->Date = $request->input('date_facture');
        $facture->Prix_HT_Total  = $request->input('prix_ht');
        $facture->Taux_TVA = $request->input('tva');
        $facture->Prix_TTC_Total = $request->input('prix_ttc');

        // Enregistrer la facture dans la base de données
        $facture->save();

        // Rediriger vers la vue ou l'action souhaitée avec un message de succès
        return redirect()->back()->with('success', 'La facture a été ajoutée avec succès.');
    }

    public function ajouterProduits($id)
    {
        $categories = Category::all();
        $allproduits = Produit::all();
        $souscategories = SubCategory::all();
        $facture = Facture::findOrFail($id);
        $produits = $facture->produits;

        return view('admin.produitfacture.produitfacture', compact('facture', 'produits', 'allproduits', 'categories', 'souscategories'));
    }

    // public function ajouterProduit(Request $request, $idFacture)
    // {
    //     // Valider les données du formulaire
    //     $validatedData = $request->validate([
    //         'nomproduit' => 'required',
    //         'description' => 'required',
    //         'Prix' => 'required',
    //         'image' => 'required|image',
    //         'mesure' => 'required',
    //         'id_categorie' => 'required',
    //         'id_souscategorie' => 'required',

    //     ]);

    //     //  Récupérer la facture existante
    //     $facture = Facture::findOrFail($idFacture);

    //     // Enregistrer le produit dans la base de données
    //     $produit = new Produit();
    //     $produit->nomproduit = $request->input('nomproduit');
    //     $produit->description = $request->input('description');
    //     $produit->Prix = $request->input('Prix');
    //     $produit->Image = $request->file('image')->storePublicly('images', 'public');
    //     $produit->mesure = $request->input('mesure');
    //     $produit->id_categorie = $request->input('id_categorie');
    //     $produit->id_souscategorie = $request->input('id_souscategorie');
    //     $produit->save();

    //     //Récupérer l'ID du produit nouvellement enregistré
    //     $produitId = $produit->id;

    //     // Attacher le produit à la facture
    //     $facture->produits()->attach($produitId, ['Quantite' => $request->input('mesure')]);

    //     // Enregistrer les modifications de la facture
    //     $facture->save();

    //     // Rediriger ou retourner une réponse appropriée
    //     return redirect()->back()->with('success', 'Le produit a été ajouté avec succès.');
    // }
    public function ajouterProduit(Request $request, $idFacture)
    {


        // Récupérer la facture existante
        $facture = Facture::findOrFail($idFacture);

        // Vérifier le type de facture sélectionné
        $typeFacture = $request->input('type_facture');

        if ($typeFacture === 'nouveau') {
            // Ajouter un nouveau produit
            // Valider les données du formulaire
            $validatedData = $request->validate([
                'nomproduit' => 'required',
                'description' => 'required',
                'Prix' => 'required',
                'image' => 'required|image',
                'mesure' => 'required',
                'id_categorie' => 'required',
                'id_souscategorie' => 'required',

            ]);

            // Enregistrer le produit dans la base de données
            $produit = new Produit();
            $produit->nomproduit = $request->input('nomproduit');
            $produit->description = $request->input('description');
            $produit->Prix = $request->input('Prix');
            $produit->Image = $request->file('image')->storePublicly('images', 'public');
            $produit->mesure = $request->input('mesure');
            $produit->id_categorie = $request->input('id_categorie');
            $produit->id_souscategorie = $request->input('id_souscategorie');
            $produit->save();

            // Récupérer l'ID du produit nouvellement enregistré
            $produitId = $produit->id;

            // Attacher le produit à la facture
            $facture->produits()->attach($produitId, ['Quantite' => $request->input('mesure')]);
        } elseif ($typeFacture === 'existant') {
            // Valider les données spécifiques au formulaire "Produit existant"
            $validatedData = $request->validate([
                'produit_existant' => 'required',
                'mesure' => 'required',
                'Prix' => 'required'
            ]);

            // Ajouter un produit existant

            // Récupérer l'ID du produit existant sélectionné
            $produitExistantId = $request->input('produit_existant');

            // Vérifier si le produit existe
            $produitExistant = Produit::find($produitExistantId);
            $produitExistant->mesure += $request->input('mesure');
            $produitExistant->Prix = $request->input('Prix');
            $produitExistant->save();

            if (!$produitExistant) {
                // Le produit n'existe pas, vous pouvez gérer cette situation en renvoyant une erreur ou en redirigeant vers une page appropriée.
                return redirect()->back()->withErrors('Le produit existant sélectionné est invalide.');
            }

            // Mettre à jour la quantité et le prix du produit existant dans la table
            $facture->produits()->attach([$produitExistantId => ['Quantite' => $request->input('mesure')]]);
        }


        // Enregistrer les modifications de la facture
        $facture->save();

        // Rediriger ou retourner une réponse appropriée
        return redirect()->back()->with('success', 'Le produit a été ajouté avec succès.');
    }
}
