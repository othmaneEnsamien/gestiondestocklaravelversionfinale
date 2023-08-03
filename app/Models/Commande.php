<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $table = 'command';

    // Relation avec le client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }


    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'commande_produit')->withPivot('quantite');
    }

    public function getTotalAmount()
    {
        $totalAmount = 0;

        foreach ($this->produits as $produit) {
            $totalAmount += $produit->Prix * $produit->pivot->quantite;
        }

        return $totalAmount;
    }
}
