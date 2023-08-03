<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactureProduit extends Model
{
    use HasFactory;
    protected $table = 'factureproduit';

    // Définir les relations avec les autres modèles
    public function facture()
    {
        return $this->belongsTo(Facture::class, 'ID_Facture');
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'ID_Produit');
    }
}
