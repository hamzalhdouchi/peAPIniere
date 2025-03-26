<?php
namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class OrderRepository implements OrderRepositoryInterface
{
    public function getSalesStats()
    {
        $totalSales = DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.statut', 'delivered') 
            ->sum(DB::raw('order_items.quantity * order_items.price'));

        $totalOrders = DB::table('orders')
            ->where('statut', 'delivered')
            ->count();

        return Response().json(['message' => 'statistic','total_sales' => $totalSales,'total_orders' => $totalOrders],200);
    }

    public function getTopPlants()
    {
        $TopPlants = DB::table('order_items')
        ->join('plantes', 'plantes.id', '=', 'order_items.plante_id')
        ->select('plantes.nomPlante', DB::raw('SUM(order_items.quantity) as total_quantity'))
        ->groupBy('plantes.nomPlante')
        ->orderByDesc('total_quantity')
        ->limit(10)
        ->get();
        return response().json(['message' => 'the top planst is get successfully','top Plant' => $TopPlants],200);
    }

    public function getSalesByCategory()
    {
        $SalesByCategory =  DB::table('order_items')
           ->join('plantes', 'plantes.id', '=', 'order_items.plante_id')
           ->join('categories', 'categories.id', '=', 'plantes.categorie_id')
           ->select('categories.name as category_name', DB::raw('SUM(order_items.quantity * order_items.price) as total_sales'))
           ->groupBy('categories.name')
           ->orderByDesc('total_sales')
           ->get();
        return response().json(['message' => 'Sales By Category','data' => $salesByCategory],200);
    }
}
