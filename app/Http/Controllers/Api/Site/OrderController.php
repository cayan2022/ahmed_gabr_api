<?php

namespace App\Http\Controllers\Api\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Site\CreateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Country;
use App\Models\Order;
use App\Models\User;

class OrderController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  CreateOrderRequest  $createOrderRequest
     * @return OrderResource
     */
    public function __invoke(CreateOrderRequest $createOrderRequest)
    {
        $user = User::firstOrCreate(['phone' => $createOrderRequest->phone,'email'=>$createOrderRequest->email],
                                    [
                                        'country_id' => Country::first()->id,
                                        'name' => $createOrderRequest->name,
                                        'type' => User::PATIENT
                                    ]);
        $order = Order::create(
            $createOrderRequest->only(['source_id', 'category_id', 'branch_id']) +
            [
                'user_id' => $user->id,
                'status_id' => Order::NEW
            ]
        );

        return new OrderResource($order);
    }
}