<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Produit;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProduitController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        $produits = Produit::paginate(5);
        $souscategories = SubCategory::all();

        return view('admin.produits.produits', compact('categories', 'produits', 'souscategories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nomproduit' => 'required|string',
            'description' => 'required|string',
            'Prix' => 'required|numeric',
            'image' => 'required|image',
            'mesure' => 'required',
            'id_categorie' => 'required|exists:categories,id',
            'id_souscategorie' => 'nullable|exists:sous_categories,id',
        ]);

        // Enregistrer le produit dans la base de données
        $produit = new Produit();
        $produit->nomproduit = $request->input('nomproduit');
        $produit->description = $request->input('description');
        $produit->Prix = $request->input('Prix');
        $produit->image = $request->file('image')->storePublicly('images', 'public');
        $produit->mesure = $request->input('mesure');
        $produit->id_categorie = $request->input('id_categorie');
        $produit->id_souscategorie = $request->input('id_souscategorie');
        $produit->save();

        // Rediriger vers une page de confirmation ou de liste des produits
        return redirect()->back()->with('success', 'Le produit a été ajouté avec succès.');
    }

    public function edit($id)
    {
        $produit = Produit::findOrFail($id);
        $categories = Category::all();
        $souscategories = SubCategory::all();

        return view('admin.produits.produits', compact('produit', 'categories', 'souscategories'));
    }

    public function update(Request $request, $id)
    {
        $produit = Produit::findOrFail($id);

        $produit->nomproduit = $request->input('nomproduit');
        $produit->prix = $request->input('prix');
        $produit->mesure = $request->input('mesure');

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image s'il en existe une
            if ($produit->image) {
                Storage::delete($produit->image);
            }

            // Enregistrer la nouvelle image
            $imagePath = $request->file('image')->store('images', 'public');
            $produit->image = $imagePath;
        }

        $produit->id_categorie = $request->input('id_categorie');
        $produit->id_souscategorie = $request->input('id_souscategorie');
        $produit->description = $request->input('description');

        $produit->save();

        return redirect()->route('produits.create')->with('success', 'Le produit a été modifié avec succès.');
    }

    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);
        if ($produit->factureProduits()->exists()) {
            return redirect()->route('produits.create')->with('error', 'Impossible de supprimer le produit car il est lié à des factures.');
        }
        // Supprimez l'image associée si elle existe
        if ($produit->image) {
            Storage::delete($produit->image);
        }

        $produit->delete();

        return redirect()->route('produits.create')->with('success', 'Le produit a été supprimé avec succès.');
    }
}