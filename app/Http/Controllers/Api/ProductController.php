<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        if ($products->count() > 0) {
            return response()->json(
                [
                    'status' => 200,
                    'products' => $products
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
            'name' => 'required|string',
            'description' => 'required|string',
            'price'  => 'required|integer',
            'stock_quantity' => 'required|integer',
            'category' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'stock_quantity' => $request->stock_quantity,
                'category ' => $request->category,
            ]);

            if ($product) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Product Created Successfully',
                    'product' => $product
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
        $product = Product::find($id);
        if ($product) {
            return response()->json([
                'status' => 200,
                'product' => $product
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Product Not Found'
            ], 404);
        }
    }

    public function edit($id)
    {
        $product = Product::find($id);
        if ($product) {
            return response()->json([
                'status' => 200,
                'product' => $product
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Product Not Found'
            ], 404);
        }
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'price'  => 'required|integer',
            'stock_quantity' => 'required|integer',
            'category' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $product = Product::find($id);
            if ($product) {

                $product->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'price' => $request->price,
                    'stock_quantity' => $request->stock_quantity,
                    'category ' => $request->category,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Product updated Successfully',
                    'product' => $product
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
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return response()->json(
                [
                    'status' => 200,
                    'message' => 'Product deleted successfully'
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'message' => 'Product not found'
                ]
            );
        }
    }
}
