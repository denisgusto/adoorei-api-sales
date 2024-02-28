<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;

class ProductController extends Controller
{
    /**
     * Retorna a lista de produtos.
     *
     * @return ProductCollection
     */
    public function index(): ProductCollection
    {
        $products = Product::query()->get();

        return new ProductCollection($products);
    }

    /**
     * Retorna o produto específico.
     *
     * @param int $id
     * @return ProductResource|JsonResponse
     */
    public function show(int $id): ProductResource|JsonResponse
    {
        $product = Product::query()->find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        return new ProductResource($product);
    }
}
