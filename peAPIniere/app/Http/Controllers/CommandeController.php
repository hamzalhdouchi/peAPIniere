<?php
namespace App\Http\Controllers;

use App\Repositories\CommandeRepositoryInterface;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    protected $orderRepository;

    public function __construct(CommandeRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @OA\Post(
     *     path="/api/orders",
     *     summary="Create a new order",
     *     description="Creates a new order.",
     *     operationId="createOrder",
     *     tags={"Orders"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"plants"},
     *             @OA\Property(
     *                 property="plants",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="slug", type="string", example="plant-slug"),
     *                     @OA\Property(property="quantity", type="integer", example=2)
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Order created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Order created successfully."),
     *             @OA\Property(property="order", type="object")
     *         )
     *     )
     * )
     */
    public function create(Request $request)
    {
        $order = $this->orderRepository->createOrder($request);

        return response()->json([
            'message' => 'Order created successfully.',
            'order' => $order,
        ], 201);
    }

    /**
     * @OA\Put(
     *     path="/api/orders/{id}/accept",
     *     summary="Accept an order",
     *     description="Accepts an order.",
     *     operationId="acceptOrder",
     *     tags={"Orders"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Order accepted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Order accepted successfully."),
     *             @OA\Property(property="order", type="object")
     *         )
     *     )
     * )
     */
    public function accept($id)
    {
        $order = $this->orderRepository->acceptOrder($id);

        return response()->json([
            'message' => 'Order accepted successfully.',
            'order' => $order,
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/orders/{id}/reject",
     *     summary="Reject an order",
     *     description="Rejects an order.",
     *     operationId="rejectOrder",
     *     tags={"Orders"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Order rejected successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Order rejected successfully."),
     *             @OA\Property(property="order", type="object")
     *         )
     *     )
     * )
     */
    public function reject($id)
    {
        $order = $this->orderRepository->rejectOrder($id);

        return response()->json([
            'message' => 'Order rejected successfully.',
            'order' => $order,
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/orders/{id}/status",
     *     summary="Update order status",
     *     description="Updates the status of an order.",
     *     operationId="updateOrderStatus",
     *     tags={"Orders"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"statut"},
     *             @OA\Property(property="statut", type="string", enum={"pending", "in_preparation", "delivered"}, example="in_preparation")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Order status updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Order status updated successfully."),
     *             @OA\Property(property="order", type="object")
     *         )
     *     )
     * )
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'statut' => 'required|in:pending,in_preparation,delivered',
        ]);

        $order = $this->orderRepository->updateOrderStatus($id, $request->statut);

        return response()->json([
            'message' => 'Order status updated successfully',
            'order' => $order,
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/orders/{id}/status",
     *     summary="Get order status",
     *     description="Gets the current status of an order.",
     *     operationId="getOrderStatus",
     *     tags={"Orders"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Order status retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="order_id", type="integer", example=1),
     *             @OA\Property(property="statut", type="string", example="in_preparation")
     *         )
     *     )
     * )
     */
    public function getStatus($id)
    {
        $status = $this->orderRepository->getOrderStatus($id);

        return response()->json([
            'order_id' => $id,
            'statut' => $status,
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/orders/{id}",
     *     summary="Delete an order",
     *     description="Deletes an existing order.",
     *     operationId="deleteOrder",
     *     tags={"Orders"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Order deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Order deleted successfully.")
     *         )
     *     )
     * )
     */
    public function destroy($id)
    {
        $destroy = $this->orderRepository->distroy($id);

        if (!$destroy) {
            return response()->json([
                'message' => 'Delete failed',
                'success' => false
            ]);
        }

        return response()->json([
            'message' => 'Order deleted successfully',
            'success' => true
        ]);
    }
}
