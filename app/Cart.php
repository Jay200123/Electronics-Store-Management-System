<?php
namespace App;
use Session;
class Cart{
public $product = null;
public $totalQty = 0;
public $totalPrice = 0;
            
public function __construct($oldCart) {
     if($oldCart) {
    $this->product = $oldCart->product;
    $this->totalQty = $oldCart->totalQty;
   $this->totalPrice = $oldCart->totalPrice;
}
}

public function add($product, $id){

$storedItem = ['qty'=>0, 'price'=>$product->sell_price, 'product'=> $product];
if ($this->product){
if (array_key_exists($id, $this->product)){
                    $storedItem = $this->product[$id];
}

}

$storedItem['qty']++;
$storedItem['price'] = $product->sell_price * $storedItem['qty'];
$this->product[$id] = $storedItem;
$this->totalQty++;
$this->totalPrice += $product->sell_price;
}

public function reduceByOne($id){
$this->product[$id]['qty']--;
$this->product[$id]['price']-= $this->product[$id]['product']['sell_price'];
$this->totalQty --;
$this->totalPrice -= $this->product[$id]['product']['sell_price'];
if ($this->product[$id]['qty'] <= 0) {
            unset($this->product[$id]);
}

}

public function removeItem($id){
$this->totalQty -= $this->product[$id]['qty'];
$this->totalPrice -= $this->product[$id]['price'];
unset($this->product[$id]);
}

}