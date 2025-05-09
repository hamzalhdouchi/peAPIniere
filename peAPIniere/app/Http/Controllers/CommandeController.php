<?php

namespace App\Http\Controllers;

use App\DTO\CommandeDTO;
use App\Http\Requests\commandStoreRequist;
use App\Http\Requests\commandUpdateRequist;
use App\RepositoryInterface\CommandeRepositoryInterface;
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
     *     summary="Create an order",
     *     tags={"Orders"},
     *     @OA\RequestBody(@OA\JsonContent(
     *         required={"plants"},
     *         @OA\Property(property="plants", type="array", @OA\Items(
     *             @OA\Property(property="slug", type="string"),
     *             @OA\Property(property="quantity", type="integer")
     *         ))
     *     )),
     *     @OA\Response(response=201, description="Order created")
     * )
     */
    public function create(commandStoreRequist $request)
    {
        $orderDTO = new CommandeDTO($request->validated());
        $order = $this->orderRepository->createOrder($orderDTO->toArray());
        return response()->json(['message' => 'Order created.', 'order' => $order], 201);
    }

    /**
     * @OA\Put(
     *     path="/api/orders/{id}/accept",
     *     summary="Accept an order",
     *     tags={"Orders"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Order accepted")
     * )
     */
    public function accept($id)
    {
        $order = $this->orderRepository->acceptOrder($id);
        return response()->json(['message' => 'Order accepted.', 'order' => $order]);
    }

    /**
     * @OA\Put(
     *     path="/api/orders/{id}/reject",
     *     summary="Reject an order",
     *     tags={"Orders"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Order rejected")
     * )
     */
    public function reject($id)
    {
        $order = $this->orderRepository->rejectOrder($id);
        return response()->json(['message' => 'Order rejected.', 'order' => $order]);
    }

    /**
     * @OA\Put(
     *     path="/api/orders/{id}/status",
     *     summary="Update order status",
     *     tags={"Orders"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(@OA\JsonContent(
     *         required={"statut"},
     *         @OA\Property(property="statut", type="string", enum={"pending", "in_preparation", "delivered"})
     *     )),
     *     @OA\Response(response=200, description="Order status updated")
     * )
     */
    public function updateStatus(commandUpdateRequist $request, $id)
    {
        $orderStatusDTO = new CommandeDTO($request->validated());
        $order = $this->orderRepository->updateOrderStatus($id, $orderStatusDTO->statut);        return response()->json(['message' => 'Status updated.', 'order' => $order]);
    }

    /**
     * @OA\Get(
     *     path="/api/orders/{id}/status",
     *     summary="Get order status",
     *     tags={"Orders"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Order status retrieved")
     * )
     */
    public function getStatus($id)
    {
        $status = $this->orderRepository->getOrderStatus($id);
        return response()->json(['order_id' => $id, 'statut' => $status]);
    }

    /**
     * @OA\Delete(
     *     path="/api/orders/{id}",
     *     summary="Delete an order",
     *     tags={"Orders"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Order deleted")
     * )
     */
    public function destroy($id)
    {
        if (!$this->orderRepository->distroy($id)) {
            return response()->json(['message' => 'Delete failed', 'success' => false]);
        }
        return response()->json(['message' => 'Order deleted', 'success' => true]);
    }

    public function index()
    {
        $order = $this->orderRepository->getAll();
        return $order;
    }
}
