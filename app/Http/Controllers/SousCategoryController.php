<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class SousCategoryController extends Controller
{
    public function getSousCategories($categorieId)
    {
        $sousCategories = SubCategory::where('id_categorie', $categorieId)->get();

        return response()->json($sousCategories);
    }
}
