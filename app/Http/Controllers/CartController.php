<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Yajra\DataTables\Exceptions\Exception;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;
use Session;
use DB;
use App\Cart;
use Auth;
use Carbon\Carbon;
use App\Models\Stock;

class CartController extends Controller
{
    public function index(){

        $products = Stock::with('product')->get();
        return view('shop.index', compact('products'));
    }

    public function getCart() {
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        // dd($oldCart);
        return view('shop.shopping-cart',['product' => $cart->product, 'totalPrice' => $cart->totalPrice]);
    }

    public function getAddToCart(Request $request , $id){
        
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? $request->session()->get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);
        $request->session()->put('cart', $cart);
        Session::put('cart', $cart);
        $request->session()->save();
        return redirect()->route('shops.index');

    }

    public function getReduceByOne($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);
        if (count($cart->product) > 0) {
            Session::put('cart',$cart);
            Session::save();
        }else{
            Session::forget('cart');
        }        
        return redirect()->route('shop.shoppingCart');
    }

    public function getRemoveItem($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if (count($cart->product) > 0) {
            Session::put('cart',$cart);
            // Session::save();
        }else{
            Session::forget('cart');
        }
         return redirect()->route('shop.shoppingCart');
    }

     public function getSession(){
        Session::flush();
    }

    public function checkout(Request $request){

        if(!Session::has('cart'))
        {
            return redirect()->route('shop.shoppingCart');
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        // dd($cart);
        
        try{
            DB::beginTransaction();
            
            $order = new Order();
            $customer = Customer::where('user_id', Auth::id())->first();
            // dd($cart->product);

            $order->customer_id = $customer->id;
            $order->date_placed = now();
            $order->date_shipped = Carbon::now()->addDays(3);
            $order->shipping = '50.00';
            $order->status = 'Processing';
            $order->save();

            foreach($cart->product as $product){
                $id = $product['product']['product_id'];
                $order->products()->attach($id,['quantity'=>$product['qty']]);

                $stock = Stock::find($id);
                $stock->quantity = $stock->quantity - $product['qty'];
                $stock->save();
            }
            // dd($order);
        }

        catch(\Exception $e)
            {
                //  dd($e);
                DB::rollBack();
                // dd($order);
                return redirect()->route('shop.shoppingCart')->with('error', $e->getMessage());
            }
            DB::commit();
            Session::forget('cart');
            return redirect()->route('shop.index')->with('Success', 'Successfully Purchased Products');
    }

   
}
