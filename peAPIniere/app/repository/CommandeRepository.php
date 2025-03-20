<?php
namespace App\Repositories;

use App\Models\Commande;
use Illuminate\Http\Request;

class CommandeRepository implements CommandeRepositoryInterface
{
    
    public function createOrder( $request)
    {
        
        $order = Commande::create($request);

        return $order;
    }

    
    public function acceptOrder( $orderId)
    {
        $order = Commande::findOrFail($orderId);
        $order->status = 'accepted'; 
        $order->save();

        return $order;
    }

    
    public function rejectOrder( $orderId)
    {
        $order = Commande::findOrFail($orderId);
        $order->status = 'rejected'; 
        $order->save();

        return $order;
    }

    public function updateOrderStatus( $orderId,  $status)
    {
        $order = Commande::findOrFail($orderId);

        $order->statut = $status;
        $order->save();

        return $order;
    }

    public function getOrderStatus( $orderId)
    {
        $order = Commande::findOrFail($orderId);
        return $order->statut;
    }

    public function distroy($orderId)
    {
        $order = Commande::findOrFail($orderId);

        $distroy = $order->delete();

        return $distroy;    
    }
}
