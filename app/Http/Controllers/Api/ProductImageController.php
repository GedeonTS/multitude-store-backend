<?php

namespace App\Http\Controllers\Api;

use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductImageController extends Controller
{
    public function index()
    {
        $products = ProductImage::all();
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
            'product_id' => 'required|string',
            'image_url' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $productImage = ProductImage::create([
                'product_id' => $request->product_id,
                'image_url' => $request->image_url,
            ]);

            if ($productImage) {
                return response()->json([
                    'status' => 200,
                    'message' => 'ProductImage Created Successfully',
                    'productImage' => $productImage
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
        $productImage = ProductImage::find($id);
        if ($productImage) {
            return response()->json([
                'status' => 200,
                'productImage' => $productImage
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'ProductImage Not Found'
            ], 404);
        }
    }

    public function edit($id)
    {
        $productImage = ProductImage::find($id);
        if ($productImage) {
            return response()->json([
                'status' => 200,
                'productImage' => $productImage
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'ProductImage Not Found'
            ], 404);
        }
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|string',
            'image_url' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $productImage = ProductImage::find($id);
            if ($productImage) {

                $productImage->update([
                    'product_id' => $request->product_id,
                    'image_url' => $request->image_url,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'ProductImage updated Successfully',
                    'productImage' => $productImage
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
        $productImage = ProductImage::find($id);
        if ($productImage) {
            $productImage->delete();
            return response()->json(
                [
                    'status' => 200,
                    'message' => 'ProductImage deleted successfully'
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'message' => 'ProductImage not found'
                ]
            );
        }
    }
}
