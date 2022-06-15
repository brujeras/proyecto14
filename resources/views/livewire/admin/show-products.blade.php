<div>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-600">
                Lista de productos
            </h2>

            <x-button-link class="ml-auto" href="{{route('admin.products.create')}}">
                Agregar producto
            </x-button-link>
        </div>

        
    </x-slot>
    
    <x-table-responsive>

        <div class="px-6 py-4">
            <x-jet-input class="w-full" wire:model="search" type="text" placeholder="Introduzca el nombre del producto a buscar"/>
        </div>

        <div class="flex justify-end my-2">
            <x-jet-button wire:click="showInactiveProducts"
                          class="text-red-700 bg-red-200 border-blue-400 shadow-sm
                          hover:bg-red-100 active:bg-red-300 active:border-red-200 focus:border-red-200 focus:ring-2 focus:ring-red-500
                          dark:bg-red-800 red:text-red-100 red:border-red-600 red:hover:bg-red-700 red:active:bg-red-700 red:active:border-red-400 red:focus:border-red-800 red:focus:ring-red-500">
                <span>Productos inactivos</span>
                <span class="ml-2 font-bold" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7a4 4 0 11-8 0 4 4 0 018 0zM9 14a6 6 0 00-6 6v1h12v-1a6 6 0 00-6-6zM21 12h-6" />
                    </svg>
                </span>
            </x-jet-button>
        </div>

        @if($products->count())
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoria</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Inactivo</th>
                <th wire:click="sortBy('quatity_sold')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Productos Vendidos</th>
                <th wire:click="sortBy('quantity_pending')" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pendiente</th>
                <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Editar</span>
                </th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($products as $product)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 object-cover">
                            <img class="h-10 w-10 rounded-full" src="{{$product->images->count() ? Storage::url($product->images->first()->url) :
                                'img/default.jpg'}}" alt="">
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">
                                {{$product->name}}
                            </div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{$product->subcategory->category->name}}</div>
                    <div class="text-sm text-gray-500">{{$product->subcategory->name}}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{$product->status == 1 ? 'red' : 'green'}}-100 text-{{$product->status == 1 ? 'red' : 'green'}}-800">
                    {{$product->status == 1 ? 'Borrador' : 'Publicado'}}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$product->price}} &euro;</td>
                <td class="px-2 py-3 text-sm">
                                <div class="flex items-center">

                                    <label for="{{ $product->id }}" class="flex items-center cursor-pointer">
                                        <!-- toggle -->
                                        <div
                                            class="px-2 py-1 mr-3 text-gray-400 font-medium font-semibold rounded-full transition ease-in-out
                                                {{ $product->disabled === null ? 'text-red-700 bg-red-100 dark:bg-red-700/25 dark:text-red-300' : ''}}">
                                            No
                                        </div>
                                        <div class="relative">
                                            <!-- input -->
                                            <input wire:click="productDisabled({{ $product->id }})"
                                                   type="checkbox"
                                                   id="{{ $product->id }}"
                                                   class="sr-only" {{ $product->disabled === null ? '' : 'checked'}}>
                                            <!-- line -->
                                            <div
                                                class="block bg-gray-200/50 w-14 h-8 rounded-full shadow-inner dark:bg-black/50"></div>
                                            <!-- dot -->
                                            <div
                                                class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full shadow-md dark:shadow-black transition dark:bg-gray-200"></div>
                                        </div>
                                        <!-- label -->
                                        <div
                                            class="px-2 py-1 ml-3 text-gray-400 font-medium font-semibold rounded-full transition ease-in-out
                                                {{ $product->disabled === null ? '' : 'text-green-700 bg-green-100 dark:bg-green-700/25 dark:text-green-300'}}">
                                            Si
                                        </div>
                                    </label>
                                </div>
                            </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$product->quantity_sold}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$product->quantity_pending}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="{{route('admin.products.edit',$product)}}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        @else
            <div class="px-6 py-4">
                No existen productos coincidentes
            </div>
        @endif
        @if($products->hasPages())
        <div class="px-6 py-4">
            {{$products->links()}}
        </div>
            @endif
    </x-table-responsive>
</div>
