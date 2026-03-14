<?php

namespace App\Http\Responses;

use App\Http\Resources\ProductResource;
use Illuminate\Contracts\Support\Responsable;

class SaleDetailsCheckoutResponse implements Responsable
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function toResponse($request)
    {
        $products = $this->getProducts();

        return response()->json([
            'id' => $this->model->id,
            'client_name' => optional($this->model->client)->name ? $this->model->client->name : 'Publico en general',
            'products' => $products,
            'status' => $this->model->status,
            'customer_phone' => $this->model->customer_phone ? $this->model->customer_phone : null,
            'created_at' => $this->model->created_at->format('Y-m-d H:i:s'),
            'total' => $this->model->total,
            'formatted_total' => number_format($this->model->total, 2),
            'typeOfSale' => $this->model->determineSaleType(),
        ]);
    }

    private function getProducts()
    {
        if ($this->model->isStockSale()) {
            $products = ProductResource::collection($this->model->products);
        } elseif ($this->model->isExpressSale()) {
            $products = $this
                ->expressSaleCompleteProductResource($this->model->concepts);
        }

        return $products;
    }

    private function expressSaleCompleteProductResource($products)
    {
        return collect($products)->map(function ($item) {
            return [
                'sale_price' => $item['price'],
                'sale_quantity' => $item['qty'],
                'description' => $item['description'],
            ];
        });
    }
}
