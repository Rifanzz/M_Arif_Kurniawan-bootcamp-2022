<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Carts;
use App\Repositories\TrOrders;
use App\Repositories\TrOrdersDetail;

class CartController extends Controller
{
    //
    public function getIndex() {
        $data['carts'] = Carts::getAllBySession();
        return view('front.cart',$data);
    }

    public function getAdd(Request $request) {
        $cart = new Carts();
        $cart->product_id = $request->products_id;
        $cart->customer_id = getCustSessions()->id;
        $cart->save();

        return redirect('cart')->with('success', 'Success add to cart');
    }

    public function getDelete($id) {
        $cart = Carts::findById($id);
        if($cart->id == null) {
            return redirect()->back()->with('danger', 'No data found');
        }
        $cart->delete();
        return redirect('cart')->with('success', 'Success delete data');
    }

    public function postCheckout(Request $request) {
        $carts = carts::getAllBySession();
        if(count($carts) == 0) {
            return redirect()->back()->with('danger', 'Cart is empty');
        }
        $total_price = 0;
        foreach($carts as $cart){
            $total_price += $cart->product_price;
        }

        //create order
        $order = new TrOrders();
        $order->code_transaction = generateCodeTransaction();
        $order->total_price = $total_price;
        $order->customer_id = getCustSessions()->id;
        $order->status = "SUCCESS";
        $order->save();

        //Create Order Detail
        foreach($carts as $cart) {
            $order_detail = new TrOrdersDetail();
            $order_detail->tr_orders_id = $order->id;
            $order_detail->products_id = $cart->product_id;
            $order_detail->price = $cart->product_price;
            $order_detail->save();
        }

        //Delete cart
        Carts::deleteBy('customer_id', getCustSessions()->id);
        return redirect('/')->with('success', 'Success Checkout');
    }
}
