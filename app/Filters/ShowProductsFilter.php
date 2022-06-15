<?php

namespace App\Filters;

class ShowProductsFilter extends QueryFilter
{
    public function rules(): array
    {
        return [
            'search' => 'filled',
            'disable' => 'in:1,0',
            'order' => 'array|size:2',
            'order.0' => 'in:quatity_sold,quantity_pending',
            'order.1' => 'in:asc,desc'
        ];
    }

    public function search($query, $search)
    {
        return $query->where(
            function ($query) use ($search) {
                $query->where('products.name', 'LIKE', "%{$search}%");
            }
        );
    }

    public function disable($query, $value)
    {
        if ($value==1){
            $query->where('products.disabled', NULL);

        } else {
            $query->where('products.disabled', '!=', NULL);
        }       
    }

    public function order($query, $value)
    {
        $query->reorder($value[0], $value[1]);
    }
}
