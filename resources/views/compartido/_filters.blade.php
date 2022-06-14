<div x-data="{open:false}">
    <x-jet-button @click="open = true">Mostrar Filtros</x-jet-button>
    <div class="justify-center" x-show="open" x-cloak>
        Categorias
        <div>
            <select wire:model="category_id">
                <option value="all" selected>Elige una categoria</option>
                @foreach($categorias as $categoria)
                    <option value="{{$categoria->id}}">{{$categoria->name}}</option>
                @endforeach
            </select>
            <label for="">Subcategoria</label>
                <select wire:model="subcategory_id">
                    <option value="all" selected>Elige una subcategoria</option>
                    @foreach($subcategories as $subcategory)
                        <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                    @endforeach
                </select>


            <select wire:model="brand_id">
                <option value="all" selected>Elige una marca</option>
                @foreach($brands as $brand)
                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                @endforeach
            </select>
            <select wire:model="color_id">
                <option value="all" selected>Elige un color</option>
                @foreach($colors as $color)
                    <option value="{{$color->id}}">{{__(ucfirst($color->name))}}</option>
                @endforeach
            </select>
                <select wire:model="color_id_size">
                    <option value="all" selected>Elige un color de una talla</option>
                    @foreach($colors as $color)
                        <option value="{{$color->id}}">{{__(ucfirst($color->name))}}</option>
                    @endforeach
                </select>
                <select wire:model="size_name">
                    <option value="all" selected>Elige una talla</option>
                    @foreach($sizes as $size)
                        <option value="{{$size->name}}">{{$size->name}}</option>
                    @endforeach
                </select>
        </div>
        <label  for="desde">Precio Desde €</label>
        <input wire:model="priceFrom" class="w-32" type="text" value="">
        <label  for="hasta">Precio Hasta €</label>
        <input wire:model="priceTo" class="w-32" type="text" value="">
        <div wire:ignore>
            <label for="desde">Desde</label>
            <input   wire:model="from" class="w-32 datepicker" type="text" placeholder="YYYY-M-D">
            <label for="hasta">Hasta</label>
            <input id="date" wire:model="to"  class="w-32 datepicker" type="text" placeholder="YYYY-M-D">
        </div>

    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        flatpickr('.datepicker', {
            enableTime: false,
            dateFormat: 'Y-m-d',
            altInput: true,
            altFormat: 'Y-m-d',
            time_24hr: true,
            allowInput: true,
        });
    });
</script>
