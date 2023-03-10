@extends('layouts.front')

@section('content')
    <div class="row front">
        <div class="col-12">
            <h2>{{$category->name}}</h2>
            <hr>
        </div>
        @if ($category->products->count())
            @foreach ($category->products as $key => $product)
            <div class="col-md-4">
                <div class="card" style="width: 100%;">
                    @if ($product->photos->count())
                        <img src="{{asset('storage/' . $product->photos->first()->image)}}" alt="card-img-top">
                    @else
                        <img src="{{asset('assets/img/no-photo.jpg')}}" alt="card-img-top">
                    @endif
                    <div class="card-body">
                        <h2 class="card-tittle">{{$product->name}}</h2>
                        <p class="card-text">
                            {{$product->description}}
                        </p>
                        <h3>
                            R$ {{number_format($product->price, '2', ',', '.')}}
                        </h3>
                        <a href="{{route('product.single', ['slug' => $product->slug])}}" class="btn btn-success">Ver Produto</a>
                    </div>
                </div>
            </div>
            @if(($key + 1) % 3 == 0) </div><div class="row front"> @endif
            @endforeach
        @else
            <div class="col-12">
                <h3 class="alert alert-warning">Nenhum Produto Encontrado Para Esta Categoria!</h3>
            </div>
        @endif
    </div>
@endsection