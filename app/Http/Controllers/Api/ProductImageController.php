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
        $productImages = ProductImage::all();
        if ($productImages->count() > 0) {
            return response()->json(
                [
                    'status' => 200,
                    'product Images' => $productImages
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
            'product_id' => 'required|integer',
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

    public function show($product_id)
    {
        //get an array of product images with the given product id
        $productImages = ProductImage::where('product_id', $product_id)->get();
        if ($productImages->count() > 0) {
            return response()->json(
                [
                    'status' => 200,
                    'productImages' => $productImages
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
                'message' => 'Product Image Not Found'
            ], 404);
        }
    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer',
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
                    'message' => 'Product Image updated Successfully',
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
                    'message' => 'Product Image deleted successfully'
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'message' => 'Product Image not found'
                ]
            );
        }
    }
}
