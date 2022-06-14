<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use function view;

class ColorColumn extends Component
{
    public $product;
    public $color;

    public function render()
    {
        return view('livewire.admin.color-column');
    }
}
