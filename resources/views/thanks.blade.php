@extends('layouts.front')

@section('content')
    <h2 class="alert alert-success">
        Muito Obrigado por sua compra!
    </h2>    
    <h3>
        Seu Pedido Foi Processado, Código Do Pedido: {{request()->get('order')}}
    </h3>    
@endsection