@extends('layouts.front')

@section('content')
    <div class="row front">
        <div class="col-3">
            @if ($store->logo)
                <img src="{{asset('storage/' . $store->logo)}}" alt="Logo da Loja {{$store->name}}" style="height: 100px" class="img-fluid">
            @else
                <img src="https://via.placeholder.com/250X100.png?text=logo" alt="Loja Sem Logo" style="height: 100px" class="img-fluid">
            @endif
        </div>
        <div class="col-9">
            <h2>{{$store->name}}</h2>
            <p>{{$store->description}}</p>
            <p>
                <strong>Contatos:</strong>
                <span>{{$store->phone}}</span> | <span>{{$store->mobile_phone}}</span>
            </p>
        </div>
        <div class="col-12">
            <hr>
            <h3>Produtos desta loja</h3>
        </div>
        @if ($store->products->count())
            @foreach ($store->products as $key => $product)
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
                <h3 class="alert alert-warning">Nenhum Produto Encontrado Para Esta Loja!</h3>
            </div>
        @endif
    </div>
@endsection