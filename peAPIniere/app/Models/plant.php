<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class plant extends Model
{
    protected $fillable = ['nomPlante', 'description', 'ptrc', 'images'];
}
