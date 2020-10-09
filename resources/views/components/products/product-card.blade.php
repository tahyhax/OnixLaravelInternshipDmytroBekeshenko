<div class="card h-100">
    <a href="{{route('products.show', [
                'product' => $product->slug,
            ])}}">
        <img class="card-img-top" src="http://placehold.it/700x400" alt="image-title">
    </a>
    <div class="card-body">
        <h4 class="card-title">
            <a href="{{route('products.show', [
                'product' => $product->slug,
            ])}}">{{$product->name}}</a>
        </h4>
        <h5>@money($product->price)</h5>
        <p class="card-text">
            {{$product->description}}
        </p>
    </div>
    <div class="card-footer">
        <div class="d-flex justify-content-end">
            {{--TODO как вывести в переводах знак валюты--}}
            <a href="javascript:void(0);"
               class="btn btn-success btn-lg">{{__('Add to cart ($:price)', ['price'=> $product->price])}}</a>
        </div>
    </div>
</div>