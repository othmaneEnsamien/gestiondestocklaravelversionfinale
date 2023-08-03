<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        return view('admin.categories.categories', compact('categories', 'subCategories'));

        // return response()->json(['categories' => $categories, 'subcategories' => $subCategories]);
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'nom_categorie' => 'required|string|max:255',
        ]);

        Category::create([
            'nom_categorie' => $request->nom_categorie,
        ]);

        // return redirect()->back()->with('success', 'Category created successfully.');
        return redirect()->back()->with('success', 'category added succesfuly');
    }

    // CategoryController.php

    public function storeSubCategory(Request $request)
    {
        $request->validate([
            'nom_souscategorie' => 'required|string|max:255',
            'id_categorie' => 'required|exists:categories,id',
        ]);

        $category = Category::findOrFail($request->id_categorie);

        // Vérifier si la sous-catégorie existe déjà pour cette catégorie
        $subCategory = $category->subCategories()->where('nom_souscategorie', $request->nom_souscategorie)->first();

        if ($subCategory) {
            // La sous-catégorie existe déjà, l'associer à la catégorie
            $subCategory->category()->associate($category);
            $subCategory->save();
        } else {
            // La sous-catégorie n'existe pas, la créer et l'associer à la catégorie
            $newSubCategory = SubCategory::create([
                'nom_souscategorie' => $request->nom_souscategorie,
                'id_categorie' => $request->id_categorie,
            ]);
        }

        // return redirect()->back()->with('success', 'Sub-category created successfully.');
        return redirect()->back()->with('success', 'Sub-category created successfully');
    }


    public function detachSubCategory(Request $request)
    {
        $categoryId = $request->input('categoryId');
        $subCategories = $request->input('subcategories');

        $category = Category::find($categoryId);

        if ($category) {
            foreach ($subCategories as $subCategoryId) {
                $subCategory = SubCategory::find($subCategoryId);

                if ($subCategory && $subCategory->id_categorie == $categoryId) {
                    $subCategory->category()->dissociate();
                    $subCategory->save();
                    return redirect()->back()->with('success', 'valid');
                }
            }

            // Effectuer d'autres opérations si nécessaire

            return redirect()->back()->with('success', 'valid');
            // return response()->json('valid.', 201);
        }

        return redirect()->back()->with('error', 'invalid');
    }
    public function destroy($id)
    {
        // Vérifier s'il existe des sous-catégories associées à la catégorie
        $category = Category::findOrFail($id);
        $subCategoriesCount = $category->subCategories()->count();

        if ($subCategoriesCount > 0) {
            return redirect()->back()->with('error', 'Supprimez d\'abord toutes les sous-catégories associées à cette catégorie.');
            // return response()->json('error.', 201);
        }

        // Supprimer la catégorie correspondante
        Category::destroy($id);

        // Rediriger vers une page de confirmation ou de liste des catégories
        return redirect()->back()->with('success', 'La catégorie a été supprimée avec succès.');
        // return response()->json('La catégorie a été supprimée avec succès.', 201);
    }
}
