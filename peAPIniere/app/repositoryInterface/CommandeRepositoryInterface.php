<?php
namespace App\RepositoryInterface;

use App\Models\Order;
use Illuminate\Http\Request;

interface CommandeRepositoryInterface
{
    public function createOrder( $request);
    public function acceptOrder($orderId);
    public function rejectOrder($orderId);
    public function updateOrderStatus($orderId, $status);
    public function getOrderStatus( $orderId);
    public function distroy($orderId);
    public function getAll();
}
