<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function addToCart($id) {

        $product = ProductModel::find($id);
        $cart = session()->get('cart');
        if ( isset($cart[$id]) ) {
            $cart[$id]['quantity'] =   $cart[$id]['quantity'] + 1;

        } else {
            $cart[$id] = [
                'name' => $product->product_title,
                'price' => $product->product_price_sell,
                'quantity' => 1,
                'image' => $product->product_main_image
            ];
        }

        session()->put('cart', $cart);

        $htmlCart = view('frontend.partials.header')->render();

        return response()->json([
            'code' => 200,
            'message' => 'success',
            'htmlHeader' => $htmlCart
        ], 200);

    }
    public function showCart() {

        $carts = session()->get('cart');
        return view('frontend.contents.cart', ["carts"=>$carts]);
    }

    public function updateCart(Request $request) {

        if ( $request->id && $request->quantity ){
            $carts = session()->get('cart');
            $carts[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $carts);
            $carts = session()->get('cart');
            $cart_view = view('frontend.contents.cart', ["carts"=>$carts])->render();
            return response()->json([
                'cart_view' => $cart_view,
                'code' => 200
            ], 200);
        }
    }

    public function deleteCart(Request $request){
        if ( $request->id ){
            $carts = session()->get('cart');
            unset($carts[ $request->id]);
            session()->put('cart', $carts);
            $carts = session()->get('cart');
            $cart_view = view('frontend.contents.cart', compact('carts'))->render();
            return response()->json([
                'cart_view' => $cart_view,
                'code' => 200
            ], 200);
        }
    }
}
