<?php

namespace App\JsonApi;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class JsonApiBuilder
{

    public function applyFilters()
    {
        return function () {
            /** @var Builder $this */
            foreach (request('filter', []) as $filter => $value) {
                abort_unless($this->hasNamedScope($filter), 400, "El filtro {$filter} no existe");
                $this->{$filter}($value);
            }
            return $this;
        };
    }


    public function applyRemovals()
    {
        return function () {
            /** @var Builder $this */
            foreach (request('remove', []) as $method => $value) {
                abort_unless($this->hasNamedScope($method), 400, "El metodo {$method} no existe");
                $this->{$method}($value);
            }
            return $this;
        };
    }
    /**
     *
     */
    public function transactions()
    {
        return function ($product) {
            /** @var Builder $this */
            $transaction = $this->model->products();
            $price = $this->model->client()->count() ?
                $this->model->client->assigned_price : 'retail_price';
            if (!$transaction->where('product_id', $product->id)->exists()) {
                $transaction->attach($product->id, [
                    /**
                     * PONGO RETAIL PRICE DEBIDO A QUE SINO SE MANDA NINGUN
                     * VALOR U OPCION DE PRECIO ESA SERA POR DEFAULT
                     * */
                    'sale_price' => $product->{$price},
                    'qty' => 1
                ]);
            }
            return $this;
        };
    }


    public function getTransaction()
    {
        return function () {
            /** @var Builder $this */
            $transaction = $this->findOrCreateTheTransaction();
            return $transaction;
        };
    }

    public function include()
    {
        // include=relationship:scope|scope,relationship,
        return function () {
            /** @var Builder $this */
            if (request()->has('include')) {
                $relationships = Str::of(request()->include)->explode(',');
                foreach ($relationships as $relationship) {
                    if (!method_exists($this->model, $relationship))
                        abort(500, 'the relationship does not exist');
                    $this->with($relationship);
                }
            }

            return $this;
        };
    }
}
