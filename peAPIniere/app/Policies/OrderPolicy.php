<?php

namespace App\Policies;

use App\Models\Commande;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    // Vérifier si l'employé peut changer l'état de la commande
    public function updateStatus(User $user, Commande $order)
    {
        // Vérifier si l'utilisateur a la permission de gérer les commandes
        return $user->hasPermissionTo('manage orders');
    }
}
