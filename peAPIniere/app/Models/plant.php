<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Plant extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = ['nomPlante', 'slug', 'description', 'ptrc', 'images'];

    // Définir le nom de la table si nécessaire
    protected $table = 'plantes';

    /**
     * Définir les options de génération de slug avec Spatie
     */
    public function getSlugOptions()
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nomPlante')  
            ->saveSlugsTo('slug');          
    }

    /**
     * La méthode getRouteKeyName permet de dire que nous allons utiliser le slug comme identifiant pour la route
     */
    public function getRouteKeyName()
    {
        return 'slug'; 
    }

    /**
     * Définir la relation avec la catégorie
     */
    public function categorie()
    {
        return $this->belongsTo(Categorie::class); 
    }

    /**
     * Définir la relation avec l'utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class); 
    }

    /**
     * La méthode boot() n'est plus nécessaire, car Spatie gère le slug automatiquement
     */
    // public static function boot()
    // {
    //     parent::boot();
    //     
    //     static::creating(function ($plant) {
    //         $plant->slug = Str::slug($plant->nomPlante, '-');
    //     });
    // }
}
