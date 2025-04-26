<?php
namespace App\Repositories;

use App\Models\Commande;
use Illuminate\Http\Request;

class CommandeRepository implements CommandeRepositoryInterface
{
    
    public function createOrder( $request)
    {
        
        $order = Commande::create($request);

        return response().json(['message' => 'the order is created successfully'],201);
    }

    
    public function acceptOrder( $orderId)
    {
        $order = Commande::findOrFail($orderId);
        $order->status = 'accepted'; 
        $order->save();

        return response().json(['message'=> 'order is accepted',true],200);
    }

    
    public function rejectOrder( $orderId)
    {
        $order = Commande::findOrFail($orderId);
        $order->status = 'rejected'; 
        $order->save();

        return response().json(['message'=> 'order is rejected',true],200);
    }

    public function updateOrderStatus( $orderId,  $status)
    {
        $order = Commande::findOrFail($orderId);

        $order->statut = $status;
        $order->save();
        return response().json(['message' => 'the update is successfully',true],200);
    }

    public function getOrderStatus( $orderId)
    {
        $order = Commande::findOrFail($orderId);
        $data = $order->statut;
        return response().json(['message'=> 'status is get successful',$data],200);
    }

    public function distroy($orderId)
    {
        $order = Commande::findOrFail($orderId);

        $distroy = $order->delete();

        return response().json(['message' => 'the command is destroy successfuly']);    
    }
}
