<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Carbon\Carbon;

class ShowFilters extends Component
{
    public $open;
    public $categorias;
    public $selCategoria;
    public $subcategoria;
    public $brands;
    public $colors;
    public $subcategory_id = [];
    public $priceFrom;
    public $priceTo;
    public $to;
    public $from;
    public $color_id;
    public $brand_id;
    public $search;



    public function render()
    {

        return view('livewire.show-filters');
    }

    public function mount()
    {

    }

    public function mostrar()
    {
        $this->open = true;
    }

    public function updatedselCategoria()
    {
        $this->subcategoria = Subcategory::where('category_id',$this->selCategoria)->get();
    }

    public function filters()
    {
        $this->emitTo('show-products2','filters',$this->selCategoria,
            $this->subcategory_id,
            $this->brand_id,
            $this->color_id,
            $this->priceFrom,
            $this->priceTo,
            $this->from,
            $this->to);

    }
}
