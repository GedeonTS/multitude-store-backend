<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        if ($orders->count() > 0) {
            return response()->json(
                [
                    'status' => 200,
                    'orders' => $orders
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'message' => "No Records Found"
                ],
                200
            );
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'total_amount' => 'required|integer',
            'order_date' => 'required|timestamp',
            'status' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $order = Order::create([
                'user_id' => $request->user_id,
                'total_amount' => $request->total_amount,
                'order_date' => $request->order_date,
                'status' => $request->status,
            ]);
        }

        if ($order) {
            return response()->json([
                'status' => 200,
                'message' => 'Order Created Successfully',
                'order' => $order
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error'
            ], 500);
        }
    }
}
