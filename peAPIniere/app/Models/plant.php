<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class plant extends Model
{
    protected $fillable = ['nomPlante', 'description', 'ptrc', 'images'];

    public function Categorie()
    {
        return $this->belongsTo(categorie::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
