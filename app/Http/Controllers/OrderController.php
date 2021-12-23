<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    /**
     * creating a new order.
     *
     * @param int $id
     * @param StoreOrderRequest $request
     * @return JsonResponse
     */
    public function create(int $id, StoreOrderRequest $request): JsonResponse
    {
        $data = Order::create([
            'order_date'=>$request->order_date,
            'bonds_purchased'=>$request->bonds_purchased,
            'bond_id'=>$id,

        ]);
        return response()->json( $data );

    }
}
