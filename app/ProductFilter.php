<?php

namespace App;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ProductFilter extends QueryFilter
{

    public function rules(): array
    {
        return [
            'search' => 'filled',
            'category' => 'exists:categories,id',
            'subcategory' => 'exists:subcategories,id',
            'brand' => 'exists:brands,id',
            'color' => 'exists:colors,id',
            'colorta' => 'exists:color_size,id',
            'size' => 'exists:sizes,name',
            'from' => 'filled|date_format:Y-m-d',
            'to' => 'filled|date_format:Y-m-d',
            'priceFrom' => 'filled|numeric',
            'priceTo' => 'filled|numeric',
        ];
    }

    public function search($query, $search)
    {
        return $query->where(function($query) use ($search) {
                    $query->where('products.name', 'LIKE', "%{$search}%");
                });
    }

    public function category($query,$category_id)
    {
                    $query->whereHas('subcategory.category',function ($query)use($category_id){
                        $query->where('categories.id',$category_id);
                    });
    }

    public function subcategory($query,$subcategory_id)
    {
        $query->where('products.subcategory_id',$subcategory_id);
    }

    public function brand($query,$brand_id)
    {
        $query->where('brand_id',$brand_id);
    }

    public function color($query,$color)
    {
        $query->whereHas('colors',function ($query) use($color){
            $query->where('color_id',$color);
        });
    }

    public function colorta($query,$color_id)
    {
        $query->whereHas('sizes.colors',function ($query)use($color_id){
            $query->where('color_id',$color_id);
        });
    }

    public function size($query,$size)
    {
        $query->whereHas('sizes',function ($query)use($size){
           $query->where('name',$size);
        });
    }

    public function priceFrom($query,$priceFrom)
    {
        $query->where('price', ">=",$priceFrom);
    }

    public function priceTo($query,$priceTo)
    {
        $query->where('price', "<=",$priceTo);
    }

    public function from($query, $date)
    {
        $date = Carbon::createFromFormat('Y-m-d', $date);

        $query->whereDate('products.created_at', '>=', $date);
    }

    public function to($query, $date)
    {
        $date = Carbon::createFromFormat('Y-m-d', $date);

        $query->whereDate('products.created_at', '<=', $date);
    }
}
