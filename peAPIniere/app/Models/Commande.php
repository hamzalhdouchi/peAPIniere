<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'plante_id', 'quantity', 'acciptaion', 'status']; 
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    
    public function plant()
    {
        return $this->belongsTo(Plant::class, 'plante_id');
    }
}
