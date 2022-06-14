<?php

namespace App\Http\Livewire\Admin;

use App\Models\Color;
use App\Models\Size;
use \App\Models\ColorSize;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class SizeColorColumn extends Component
{
    public $product;

    public function render()
    {
        $color = Color::whereHas('sizes.product',function(Builder $query){
            $query->where('product_id',$this->product->id);
        })->get();

        return view('livewire.admin.size-color-column',compact('color'));
    }

}
