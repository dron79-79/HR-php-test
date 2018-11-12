<?php
namespace App\Repositories;
use App\Order;
use Carbon\Carbon;

class OrderRepository {
    
    public function getOrders(){
	$orders = Order::with('partner')->with('products')->get();
	//Так как полей для формирования таблицы нужно всего 5 и длинна полей небольшая максиум varchar256(4 байта)
	//то мною принято решение вместо пяти обращений к базе данных сделать одно, 
	//тем более что по условию ТЗ список заказов не лимитирован и тяжелый запрос
	// на выборку всех заказов все равно должен будет сделан.
	
	//По хорошему вывод заказов всегда должен быть под лимитом
	//При просмотре табов дополнительные таблицы подгружать при необходимости с помощью ajax запросов.
	return $this->makeOrdersDataArray($orders);
		
    }

    

    
    protected function makeOrdersDataArray($ordersSource)
    {
        /* @var $orders Illuminate\Database\Eloquent\Collection  */
	$orders = $overdue = $current = $new = $performed = [];
	$orderArray = [];
	
	foreach ($ordersSource as $order){
	    $products_name =[];
	    $products_sum = 0;
	    
	    foreach ($order->products as $product)
	    {
		$products_sum += $product->pivot->quantity * $product->pivot->price;
		$products_name[] = $product->name;
	    }
	    
	    $products_name = array_unique($products_name);
	    $orderArray['id'] =  $order->id;
	    $orderArray['parnter_name'] = $order->partner->name;
	    $orderArray['products_sum'] = $products_sum;    
	    $orderArray['products_name'] = implode (', ', $products_name );
	    $orderArray['status'] = $order->status; 
	    
 	    switch ($this->markerOrder($order)) { 
		case 'overdue': 
		    $overdue[] = $orderArray;
		    break; 
		case 'current': 
		    $current[] = $orderArray;
		    break; 
		case 'new': 
		    $new[] = $orderArray;
		    break; 
		case 'performed': 
		    $performed[] = $orderArray;
		    break; 
	    } 
	    $orders[] = $orderArray;
            
        }
        
	$overdue = array_reverse($overdue);
	$overdue = array_chunk($overdue, 50);
	$overdue = empty($overdue)?[]:$overdue['0'];
	$performed = array_reverse($performed);
	$performed = array_chunk($performed, 50);
	$performed = empty($performed)?[]:$performed['0'];
	$new = array_chunk($new, 50);
	$new = empty($new)?[]:$new['0'];
	
	return compact('orders','overdue','current','new','performed');
    }
    
    /**
     * маркировка заказов согласно условиям ТЗ
     * @param Order $order
     * @return string
     */
    protected function markerOrder(Order $order){
	$marker = '';
	$curent_date = Carbon::now()->format('Y-m-d H:i:s');
	$date_to = Carbon::now()->addDay()->format('Y-m-d H:i:s'); 
	$date_today = Carbon::today()->format('Y-m-d H:i:s');
	$date_tomorrow = Carbon::tomorrow()->subSecond()->format('Y-m-d H:i:s');
	
	if (($order->delivery_dt < $curent_date)&&($order->status === Order::ORDER_CONFIRMED)){
		//просрочка
		$marker = 'overdue';
	    } elseif(($order->delivery_dt < $date_to)&&($order->delivery_dt >= $curent_date)&&($order->status === Order::ORDER_CONFIRMED)) {
		//текущая доставка
		$marker = 'current';
	    } elseif(($order->delivery_dt > $curent_date)&&($order->status === Order::ORDER_NEW)){
		//новые заказы на доставку
		$marker = 'new';
	    } elseif (($order->delivery_dt >= $date_today)&&($order->delivery_dt < $date_tomorrow)&&($order->status === Order::ORDER_COMPLETED)) {
		//выполннные доставки
		$marker = 'performed';
	    }
	    
	return $marker;
    }

        
    
    public function getProductsList(Order $order)
    {
        $productsList = array();
        $orderProducts = $order->order_products;
        $products_sum = 0;
	$i=0;
	
	foreach ($orderProducts as $orderProduct){
            $productsList[$i]['price'] = $orderProduct->price;
            $productsList[$i]['name'] = $orderProduct->product->name;
	    $productsList[$i]['quantity'] = $orderProduct->quantity;
            $products_sum += $orderProduct->quantity * $orderProduct->price;
	    $i++;
        }
        
	return compact('productsList', 'products_sum');
    }
}

