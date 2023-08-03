<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;
    protected $table = 'factures';
    protected $primaryKey = 'id';
    public $timestamps = false;



    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'factureproduit', 'ID_Facture', 'ID_Produit')
            ->withPivot('Quantite');
    }
}