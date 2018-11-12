@extends('layouts.layout')
@section('title')
    Список заказов
@endsection
@section('content')
    <div class="container">
	<h3>Список заказов</h3>
	<ul class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
	    <li class="nav-item" role="presentation">
		<a class="nav-link active" id="nav-all-tab" data-toggle="tab" href="#nav-all" role="tab" aria-controls="nav-all" aria-selected="true">Все</a>
	    </li>
	    <li class="nav-item" role="presentation">
		<a class="nav-link" id="nav-overdue-tab" data-toggle="tab" href="#nav-overdue" role="tab" aria-controls="nav-overdue" aria-selected="false">Просроченные</a>
	    </li>
	    <li class="nav-item" role="presentation">
		<a class="nav-link" id="nav-current-tab" data-toggle="tab" href="#nav-current" role="tab" aria-controls="nav-current" aria-selected="false">Текущие</a>
	    </li>
	    <li class="nav-item" role="presentation">
		<a class="nav-link" id="nav-new-tab" data-toggle="tab" href="#nav-new" role="tab" aria-controls="nav-new" aria-selected="false">Новые</a>
	    </li>
	    <li class="nav-item" role="presentation">
		<a class="nav-link" id="nav-performed-tab" data-toggle="tab" href="#nav-performed" role="tab" aria-controls="nav-performed" aria-selected="false">Выполненные</a>
	    </li>
	</ul>
	<div class="tab-content" id="nav-tabContent">
	    <div class="tab-pane active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
		<table id="orders-table-all" class="container table">
		    <thead>
			<tr class='row header'>
			    <th class='header col-xs-offset-5' >ID заказа</th>
			    <th class='header' >Партнёр</th>
			    <th class='header' >Сумма</th>
			    <th class='header' >Состав заказа</th>
			    <th class='header' >Статус</th>
			</tr>
		    </thead>
		    <tbody>
			<?php $i=0; ?>
		    @foreach($result['orders'] as $order)
		    <tr class="row <?= $i%2?'info':'' ?>" >
			<td class="col-xs-offset-5">
				<a href="{{ action('Orders\OrderController@edit', [$order['id']]) }}" target="_blank">{{$order['id']}}</a>
			    </td>
			    <td>
				{{$order['parnter_name']}}
			    </td>
			    <td>
				{{$order['products_sum']}}
			    </td>
			    <td>
				{{$order['products_name']}}
			    </td>
			    <td>
				{{$order['status']}}
			    </td>
			</tr>
			<?php $i++;?>
		    @endforeach
		    </tbody>
		</table>
	    </div>
	    <div class="tab-pane" id="nav-overdue" role="tabpanel" aria-labelledby="nav-overdue-tab">
		<table id="orders-table-overdue" class="container table">
		    <thead>
			<tr class='row header'>
			    <th class='header col-xs-offset-5' >ID заказа</th>
			    <th class='header' >Партнёр</th>
			    <th class='header' >Сумма</th>
			    <th class='header' >Состав заказа</th>
			    <th class='header' >Статус</th>
			</tr>
		    </thead>
		    <tbody>
			<?php $i=0; ?>
		    @foreach($result['overdue'] as $order)
		    <tr class="row <?= $i%2?'info':'' ?>" >
			<td class="col-xs-offset-5">
				<a href="{{ action('Orders\OrderController@edit', [$order['id']]) }}" target="_blank">{{$order['id']}}</a>
			    </td>
			    <td>
				{{$order['parnter_name']}}
			    </td>
			    <td>
				{{$order['products_sum']}}
			    </td>
			    <td>
				{{$order['products_name']}}
			    </td>
			    <td>
				{{$order['status']}}
			    </td>
			</tr>
			<?php $i++;?>
		    @endforeach
		    </tbody>
		</table>
	    </div>
	    <div class="tab-pane" id="nav-current" role="tabpanel" aria-labelledby="nav-current-tab">
		<table id="orders-table-current" class="container table">
		    <thead>
			<tr class='row header'>
			    <th class='header col-xs-offset-5' >ID заказа</th>
			    <th class='header' >Партнёр</th>
			    <th class='header' >Сумма</th>
			    <th class='header' >Состав заказа</th>
			    <th class='header' >Статус</th>
			</tr>
		    </thead>
		    <tbody>
			<?php $i=0; ?>
		    @foreach($result['current'] as $order)
		    <tr class="row <?= $i%2?'info':'' ?>" >
			<td class="col-xs-offset-5">
				<a href="{{ action('Orders\OrderController@edit', [$order['id']]) }}" target="_blank">{{$order['id']}}</a>
			    </td>
			    <td>
				{{$order['parnter_name']}}
			    </td>
			    <td>
				{{$order['products_sum']}}
			    </td>
			    <td>
				{{$order['products_name']}}
			    </td>
			    <td>
				{{$order['status']}}
			    </td>
			</tr>
			<?php $i++;?>
		    @endforeach
		    </tbody>
		</table>
	    </div>
	    <div class="tab-pane" id="nav-new" role="tabpanel" aria-labelledby="nav-new-tab">
		<table id="orders-table-new" class="container table">
		    <thead>
			<tr class='row header'>
			    <th class='header col-xs-offset-5' >ID заказа</th>
			    <th class='header' >Партнёр</th>
			    <th class='header' >Сумма</th>
			    <th class='header' >Состав заказа</th>
			    <th class='header' >Статус</th>
			</tr>
		    </thead>
		    <tbody>
			<?php $i=0; ?>
		    @foreach($result['new'] as $order)
		    <tr class="row <?= $i%2?'info':'' ?>" >
			<td class="col-xs-offset-5">
				<a href="{{ action('Orders\OrderController@edit', [$order['id']]) }}" target="_blank">{{$order['id']}}</a>
			    </td>
			    <td>
				{{$order['parnter_name']}}
			    </td>
			    <td>
				{{$order['products_sum']}}
			    </td>
			    <td>
				{{$order['products_name']}}
			    </td>
			    <td>
				{{$order['status']}}
			    </td>
			</tr>
			<?php $i++;?>
		    @endforeach
		    </tbody>
		</table>
	    </div>
	    <div class="tab-pane" id="nav-performed" role="tabpanel" aria-labelledby="nav-performed-tab">
		<table id="orders-table-performed" class="container table">
		    <thead>
			<tr class='row header'>
			    <th class='header col-xs-offset-5' >ID заказа</th>
			    <th class='header' >Партнёр</th>
			    <th class='header' >Сумма</th>
			    <th class='header' >Состав заказа</th>
			    <th class='header' >Статус</th>
			</tr>
		    </thead>
		    <tbody>
			<?php $i=0; ?>
		    @foreach($result['performed'] as $order)
		    <tr class="row <?= $i%2?'info':'' ?>" >
			<td class="col-xs-offset-5">
				<a href="{{ action('Orders\OrderController@edit', [$order['id']]) }}" target="_blank">{{$order['id']}}</a>
			    </td>
			    <td>
				{{$order['parnter_name']}}
			    </td>
			    <td>
				{{$order['products_sum']}}
			    </td>
			    <td>
				{{$order['products_name']}}
			    </td>
			    <td>
				{{$order['status']}}
			    </td>
			</tr>
			<?php $i++;?>
		    @endforeach
		    </tbody>
		</table>
	    </div>
	</div>
        
    </div>
@endsection

