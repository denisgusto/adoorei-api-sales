<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\SaleResource;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SaleController extends Controller
{
    /**
     * Retorna a lista de vendas.
     *
     * @return ResourceCollection
     */
    public function index(): ResourceCollection
    {
        $sales = Sale::with('products')->get();

        return SaleResource::collection($sales);
    }

    /**
     * Retorna a venda específica.
     *
     * @param int $id
     * @return SaleResource|JsonResponse
     */
    public function show(int $id): SaleResource|JsonResponse
    {
        $sale = Sale::with('products')->find($id);

        /* Verifica se a venda existe */
        if (!$sale) {
            return response()->json(['message' => 'Sale not found.'], 404);
        }

        return new SaleResource($sale);
    }

    /**
     * Cria uma nova venda.
     *
     * @param StoreSaleRequest $request
     * @return SaleResource
     */
    public function store(StoreSaleRequest $request): SaleResource
    {
        try {
            $sale = Sale::create();

            /* Adiciona os produtos na venda */
            foreach ($request->products as $product) {
                $sale->products()->attach($product['id'], ['amount' => $product['amount']]);
            }

            return new SaleResource($sale);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating sale.'], 500);
        }
    }

    /**
     * Atualiza uma venda.
     *
     * @param UpdateSaleRequest $request
     * @param int $id
     * @return SaleResource|JsonResponse
     */
    public function update(UpdateSaleRequest $request, int $id): SaleResource|JsonResponse
    {
        $sale = Sale::find($id);

        /* Verifica se a venda existe */
        if (!$sale) {
            return response()->json(['message' => 'Sale not found.'], 404);
        }

        /* Verifica se a venda está cancelada */
        if($sale->status === 'canceled') {
            return response()->json(['message' => 'Sale is already canceled.'], 400);
        }

        try {
            /* Adiciona os produtos na venda */
            foreach ($request->products as $product) {
                $sale->products()->attach($product['id'], ['amount' => $product['amount']]);
            }

            return new SaleResource($sale);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating sale.'], 500);
        }
    }

    /**
     * Cancela uma venda.
     *
     * @param int $id
     * @return SaleResource|JsonResponse
     */
    public function cancel(int $id)
    {
        $sale = Sale::find($id);

        /* Verifica se a venda existe */
        if (!$sale) {
            return response()->json(['message' => 'Sale not found.'], 404);
        }

        /* Verifica se a venda está cancelada */
        if($sale->status === 'canceled') {
            return response()->json(['message' => 'Sale is already canceled.'], 400);
        }

        try {
            $sale->status = 'canceled';
            $sale->save();

            return new SaleResource($sale);
        } catch (\Exception $e) {
            return $e->getMessage();
            return response()->json(['message' => 'Error canceling sale.'], 500);
        }
    }
}
