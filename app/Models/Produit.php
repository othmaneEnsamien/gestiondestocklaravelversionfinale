<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $table = 'produits';


    protected $fillable = ['nomproduit', 'description', 'Prix', 'image', 'mesure', 'id_categorie', 'id_souscategorie'];
    public function categorie()
    {
        return $this->belongsTo(Category::class, 'id_categorie');
    }

    public function sousCategorie()
    {
        return $this->belongsTo(SubCategory::class, 'id_souscategorie');
    }

    public function factures()
    {
        return $this->belongsToMany(Facture::class, 'factureproduit', 'ID_Produit', 'ID_Facture')
            ->withPivot('Quantite');
    }
    public function factureProduits()
    {
        return $this->hasMany(FactureProduit::class, 'ID_Produit');
    }
    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'commande_produit')->withPivot('quantite');
    }

    public function pivotQuantity()
    {

        return $this->quantite ?? 0;
    }
}
