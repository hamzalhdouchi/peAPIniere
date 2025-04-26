<?php

namespace App\Http\Controllers;

use App\Repositories\OrderRepositoryInterface;
use Illuminate\Http\JsonResponse;

class StatisticsController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @OA\Get(
     *     path="/api/statistics/sales",
     *     summary="Get sales statistics",
     *     description="Fetches the total sales and total orders.",
     *     operationId="getSalesStats",
     *     tags={"Statistics"},
     *     @OA\Response(
     *         response=200,
     *         description="Sales statistics retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="total_sales", type="number", example=1000.5, description="Total sales amount"),
     *             @OA\Property(property="total_orders", type="integer", example=200, description="Total number of orders")
     *         )
     *     )
     * )
     */
    public function salesStats(): JsonResponse
    {
        $stats = $this->orderRepository->getSalesStats();
        return response()->json($stats);
    }

    /**
     * @OA\Get(
     *     path="/api/statistics/top-plants",
     *     summary="Get top-selling plants",
     *     description="Fetches the top-selling plants based on orders.",
     *     operationId="getTopPlants",
     *     tags={"Statistics"},
     *     @OA\Response(
     *         response=200,
     *         description="Top-selling plants retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="top_plants", type="array", @OA\Items(type="object"))
     *         )
     *     )
     * )
     */
    public function topPlants(): JsonResponse
    {
        $topPlants = $this->orderRepository->getTopPlants();
        return response()->json(['top_plants' => $topPlants]);
    }

    /**
     * @OA\Get(
     *     path="/api/statistics/sales-by-category",
     *     summary="Get sales by category",
     *     description="Fetches sales statistics broken down by category.",
     *     operationId="getSalesByCategory",
     *     tags={"Statistics"},
     *     @OA\Response(
     *         response=200,
     *         description="Sales by category retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="sales_by_category", type="array", @OA\Items(type="object"))
     *         )
     *     )
     * )
     */
    public function salesByCategory(): JsonResponse
    {
        $salesByCategory = $this->orderRepository->getSalesByCategory();
        return response()->json(['sales_by_category' => $salesByCategory]);
    }
}
