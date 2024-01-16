<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

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
                'status' => $request->status,
            ]);

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

    public function show($id)
    {
        $order = Order::find($id);
        if ($order) {
            return response()->json([
                'status' => 200,
                'order' => $order
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Order Not Found'
            ], 404);
        }
    }

    public function edit($id)
    {
        $order = Order::find($id);
        if ($order) {
            return response()->json([
                'status' => 200,
                'order' => $order
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Order Not Found'
            ], 404);
        }
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'total_amount' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $order = Order::find($id);
            if ($order) {

                $order->update([
                    'user_id' => $request->user_id,
                    'total_amount' => $request->total_amount,
                    'status' => $request->status,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Order updated Successfully',
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

    public function destroy($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->delete();
            return response()->json(
                [
                    'status' => 200,
                    'message' => 'Order deleted successfully'
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'message' => 'Order not found'
                ]
            );
        }
    }
}
