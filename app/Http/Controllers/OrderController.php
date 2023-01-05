<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Bond;
use App\Models\Order;
use App\Repositories\BondRepository;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    /**
     * @var BondRepository
     */
    private $bondRepository;

    public function __construct(BondRepository $bondRepository)
    {
        $this->bondRepository = $bondRepository;
    }
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



    public function interestPayments($order_id, Request $request){
        $order = $this->bondRepository->getOrder($order_id);
        $payouts = $this->bondRepository->getPayouts($order->bond_id);
        $percent = $this->bondRepository->getPercent($order->bond_id);
        $payments = $this->bondRepository
            ->accumulatedInterest($payouts,$percent,$order->bonds_purchased,$order->order_date);
        return response()->json($payments);
    }
}
