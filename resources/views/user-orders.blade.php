@extends('layouts.front')

@section('content')
    <div class="col-12">
        <h2>Meus Pedidos</h2>
        <hr>
    </div>

    <div class="col-12">
        <div class="accordion" id="accordionExample">
            @forelse ($userOrders as $key => $order)
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapseOne">
                                Pedido nº {{$order->reference}}
                            </button>
                        </h2>
                    </div>

                    <div id="collapse{{$key}}" class="collapse @if($key == 0) show @endif" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                @php $items = unserialize($order->items); @endphp
                                @foreach ($items as $item)
                                    <li>{{$item['name']}} | R$ {{number_format($item['price'], 2, ',', '.')}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning">Nenhum Pedido Recebido!</div>
            @endforelse
        </div>
    </div>
    <div class="col-12">
        <hr>
        {{$userOrders->links()}}
    </div>
@endsection