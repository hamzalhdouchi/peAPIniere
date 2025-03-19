<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class categorie extends Model
{
    protected $fillable = ['nom_Categorie','description'];

    public function plant()
    {
        return $this->hasMany(plant::class);
    }
}
