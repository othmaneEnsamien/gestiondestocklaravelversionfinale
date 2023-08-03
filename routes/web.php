<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SousCategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'userRolesPermissionsChart'])->name('home');


Route::get('/clients', [ClientController::class, 'index'])->name('clients');


//categories

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/categories', [CategoryController::class, 'storeCategory'])->name('categories.store');
Route::post('/subcategories', [CategoryController::class, 'storeSubCategory'])->name('subcategories.store');
Route::post('categories/subcategories/detach', [CategoryController::class, 'detachSubCategory'])->name('categories.subcategories.detach');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');


//produits

Route::get('/produits/create', [ProduitController::class, 'create'])->name('produits.create');
Route::post('/produits', [ProduitController::class, 'store'])->name('produits.store');
Route::get('/souscategories/{categorieId}', [SousCategoryController::class, 'getSousCategories']);
Route::get('produits/{id}/edit', [ProduitController::class, 'edit'])->name('produits.edit');
Route::put('produits/{id}', [ProduitController::class, 'update'])->name('produits.update');
Route::delete('/produits/{id}', [ProduitController::class, 'destroy'])->name('produits.destroy');

// factures 
Route::get('/factures/create', [FactureController::class, 'create'])->name('factures.create');
Route::post('/facture', [FactureController::class, 'store'])->name('facture.store');
Route::get('/produits-facture/{facture}', [FactureController::class, 'ajouterProduits'])->name('facture.ajouterProduits');
Route::post('/factures/{idFacture}/ajouter-produit', [FactureController::class, 'ajouterProduit'])->name('factures.ajouter-produit');

//commandes
Route::get('/commandes', [CommandeController::class, 'create'])->name('commandes.create');
// Route pour obtenir les sous-catégories associées à une catégorie
Route::get('/getSubCategories/{categorieId}', [CommandeController::class, 'getSubCategories']);

// Route pour obtenir les produits associés à une sous-catégorie
Route::get('/getProducts/{subCategorieId}', [CommandeController::class, 'getProducts']);

// Route pour obtenir la quantité disponible d'un produit
Route::get('/getProductQuantity/{produitId}', [CommandeController::class, 'getProductQuantity']);

// Route pour enregistrer la commande
Route::post('/saveCommande', [CommandeController::class, 'addCommande'])->name('commande.save');



Route::post('/commande/update-etat', [CommandeController::class, 'updateEtat'])->name('commande.update-etat');








//users
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::get('/users-roles-permissions', [UserController::class, 'showUsersRolesAndPermissions'])->name('users.roles.permissions');

//permissions
Route::get('/permissions', [PermissionController::class, 'managePermissions'])->name('permissions.manage');
Route::post('/permissions', [PermissionController::class, 'storePermission'])->name('permissions.store');
Route::get('/permissions/{permission}/edit', [PermissionController::class, 'editPermission'])->name('permissions.edit');
Route::put('/permissions/{permission}', [PermissionController::class, 'updatePermission'])->name('permissions.update');
Route::delete('/permissions/{permission}', [PermissionController::class, 'destroyPermission'])->name('permissions.destroy');

//roles
Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
