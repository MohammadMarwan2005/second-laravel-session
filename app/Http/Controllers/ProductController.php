<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function getAllProducts()
    {
    $filePath = 'C:\Users\AHMED\Desktop\second-laravel-session\products.json';

    $fileContents = file_get_contents($filePath);
    $products = json_decode($fileContents, true);
    return response()->json([
        'message' => 'Products retrieved successfully!',
        'products' => $products,
    ], 200);

    }

    public function addProduct(Request $request)
    {

        $filePath = 'C:\Users\AHMED\Desktop\second-laravel-session\products.json';
        
        $fileContents = file_get_contents($filePath);

        $products = json_decode($fileContents, true);

        $newId = $products ? max(array_column($products, 'id')) + 1 : 1;


        $newProduct = [
            'id' => $newId,
            'name' => $request->name,
            'price' => $request->price,
        ];
        $products[] = $newProduct;

        if (file_put_contents($filePath, json_encode($products, JSON_PRETTY_PRINT))) {
            return response()->json([
                'message' => 'Product created successfully!',
                'product' => $newProduct,
            ], 201);
        }
    }

    public function updateProduct(Request $request)
    {

        $filePath = 'C:\Users\AHMED\Desktop\second-laravel-session\products.json';
        
        $fileContents = file_get_contents($filePath);

        $products = json_decode($fileContents, true);

        $productId = $request->id;
        $productIndex = array_search($productId, array_column($products, 'id'));

        if ($productIndex === false) {
            return response()->json([
                'message' => 'Product not found.',
            ], 404);
        }
        $product = $products[$productIndex];
        

        $products[$productIndex]['name'] = $request->input('name', $product['name']);
        $products[$productIndex]['price'] = $request->input('price', $product['price']);

        if (file_put_contents($filePath, json_encode($products, JSON_PRETTY_PRINT))) {
            return response()->json([
                'message' => 'Product updated successfully!',
                'product' => $products[$productIndex],
            ], 200);
    }
    }
}
