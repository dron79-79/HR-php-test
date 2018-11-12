@extends('layouts.layout')
@section('title')
    Редактирование заказа {{$order->id}}
@endsection
@section('content')
     @if ($errors->any())
        <div class=" container alert alert-danger" role='alert'>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
     <div class="container">
	<h3>Редактирование заказа № <strong>{{$order->id}}</strong></h3>
        <form class="form-horizontal" method="post" action="{{ action('Orders\OrderController@update', [$order->id]) }}">
            {!! csrf_field() !!}
            <input type="hidden" name="order_id" value="$order->id">
            <div class="form-group row">
                <label for="inputPassword" class="control-label col-xs-3">Email клиента</label>
                <div class="col-xs-7">
                    <input type="text" name="client_email" class="form-control" value={{$order->client_email}}>
                </div>
            </div>
             <div class="form-group row">
                <label for="inputPassword" class="control-label col-xs-3">Партнер</label>
                <div class="col-xs-7">
                    <input type="text" name="partner" class="form-control" value={{$order->partner->name}}>
                </div>
            </div>
             <div class="form-group row">
                <label for="inputEmail" class="control-label col-xs-3">Продукты</label>
                <div class="col-xs-7">
                    @foreach($products['productsList'] as $product)
                        <div class="product-row">{{$product['name']}} в количестве {{$product['quantity']}} шт. стоимостью {{$product['price']}} руб.</div>
                    @endforeach
                </div>
            </div>
             <div class="form-group row">
                <label for="inputPassword" class="control-label col-xs-3">Статус заказа</label>
                <div class="col-xs-7">
                    <select class="form-control"  name="order_status">
                        <option value="{{ \App\Order::ORDER_NEW }}" {{ $order->status == \App\Order::ORDER_NEW ? 'selected' : '' }}>Новый</option>
                        <option value="{{ \App\Order::ORDER_CONFIRMED }}" {{ $order->status == \App\Order::ORDER_CONFIRMED ? 'selected' : '' }}>Подтверждён</option>
                        <option value="{{ \App\Order::ORDER_COMPLETED }}" {{ $order->status == \App\Order::ORDER_COMPLETED ? 'selected' : '' }}>Завершён</option>
                    </select>
                </div>
            </div>
             <div class="form-group row">
                <label for="inputPassword" class="control-label col-xs-3">Общая стоимость заказа</label>
                <div class="col-xs-7">
                    <p class="form-control-static">{{$products['products_sum'].' руб.'}}</p>
                </div>
            </div>
             <div class="form-group">
                <div class="col-xs-12 btn-row">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </div>
        </form>
    </div>
@endsection