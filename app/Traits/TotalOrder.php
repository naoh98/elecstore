<?php

namespace App\Traits;



use Illuminate\Http\Request;

trait TotalOrder {
    public function getTotalOrder() {
        $carts = session()->get('cart');

        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart['quantity'] * $cart['price'];
        }
        return $total;
    }

    public function getTotalQuantity() {
        $carts = session()->get('cart');
        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart['quantity'];
        }
        return $total;
    }

    public function destroyCart(Request $request) {
       $request->session()->forget('cart');
    }
}
