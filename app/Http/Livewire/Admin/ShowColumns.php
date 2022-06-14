<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class ShowColumns extends Component
{
    public $columnaCheck;
    public $columnas;
    public $mostrar;

    public function mount()
    {
        $this->columnaCheck =  $this->columnas;
    }
    public function render()
    {
        return view('livewire.admin.show-columns');
    }

    public function mostrarOcultar()
    {
        $this->mostrar = true;
    }
}
