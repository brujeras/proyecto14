<div>
    @foreach($product->colors as $color)
        <div class="text-sm text-gray-900">{{$color->name}}</div>
    @endforeach
</div>
