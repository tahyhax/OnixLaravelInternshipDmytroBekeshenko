<div class="card h-100">
    <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
    <div class="card-body">
        <h4 class="card-title">
            {{--<a href="{{route('products.show', [--}}
                {{--'category' => $category->slug,--}}
                {{--'product' => $product->slug,--}}
            {{--])}}">{{$product->name}}</a>--}}
        </h4>
        <h5>{{$product->price}}</h5>
        <p class="card-text">
            {{$product->description}}
        </p>
    </div>
    <div class="card-footer">
        {{--<small class="text-muted">★ ★ ★ ★ ☆</small>--}}
    </div>
</div>