<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    
    const ORDER_NEW = 0;
    const ORDER_CONFIRMED = 10;
    const ORDER_COMPLETED = 20;
    
    protected $table = 'orders';
    
    
    public function partner() {
        
	return $this->belongsTo('App\Partner');
    }
   
    public function products() {

	return $this->belongsToMany('App\Product', 'order_products')->withPivot('quantity', 'price');
    }
    
    public function order_products() {
        
	return $this->hasMany('App\OrderProduct');
    }
    
}
