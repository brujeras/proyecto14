<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use App\Filters\ShowProductsFilter;

class ShowProducts extends Component
{
    use WithPagination;
    public $search;
    public $sortDirection;
    public $sortField;
    public $thrashed = false; 

    public function render(ShowProductsFilter $paramsProducts)
    {
        return view('livewire.admin.show-products',['products' => $this->getProducts($paramsProducts)])->layout('layouts.admin');
    }

    protected function getProducts(ShowProductsFilter $paramsProducts)
    {
        $product = Product::query()->withTrashed()
        ->filterBy(
            $paramsProducts, array_merge(
                [
                    'search' => $this->search,
                    'disable' => $this->thrashed ? 1 :0,
                    'order' => [$this->getColumnName($this->sortField), $this->sortDirection]
                ]
            )
        )
        ->paginate();
        $product->appends($paramsProducts->valid());                

        return $product;
    }

    public function productDisabled($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        if ($product->disabled === null) {
            $product->disabled = Carbon::now()->format('Y-m-d');
        } else {
            $product->disabled = null;
        }
        $product->save();
    }

    public function showInactiveProducts()
    {        
        $this->resetPage();
        $this->thrashed = $this->thrashed == true ? false : true;
    }


    protected function getColumnName($alias)
    {
        return $this->aliases[$alias] ?? $alias;
    }

    public function sortBy($field)
    {
        $this->sortDirection = $this->sortField === $field
            ? $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc'
            : 'asc';

        $this->sortField = $field;
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
