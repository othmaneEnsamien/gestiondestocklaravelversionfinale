<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table = 'sous_categories';

    protected $fillable = [
        'nom_souscategorie',
        'id_categorie',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_categorie');
    }
}