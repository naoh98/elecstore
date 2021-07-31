<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\OrderItemModel;
use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Traits\TotalOrder;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    //
    use TotalOrder;


    public function index() {
        $carts = session()->get('cart');

        return view('frontend.contents.checkout', compact('carts'));

    }

    public function storeOrder(Request $request) {

        $order = new OrderModel();

        $validate =[
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'phone_number' => 'required'

        ];
        $error_messages = [
            'required' => ':attribute is required',
            'unique' => ':attribute existed'
        ];

        $this->validate($request, $validate, $error_messages);

        $total_order = $this->getTotalOrder();
        $total_quantity = $this->getTotalQuantity();

        $order->order_number = 'ORD-'. strtoupper(uniqid());
        $order->user_id = auth()->user()->id;
        $order->status = 'pending';
        $order->grand_total = $total_order;
        $order->item_count = $total_quantity;

        $order->payment_status = 0;
        $order->payment_method = $request->payment_method;

        $order->first_name = $request->first_name;
        $order->last_name = $request->last_name;
        $order->address = $request->address;
        $order->city = $request->city;
        $order->country = $request->country;
        $order->phone_number = $request->phone_number;
        $order->notes = $request->notes;
        $order->save();

        if ( $order ){
            $items = session()->get('cart');



            foreach ($items as $item) {
                $product = ProductModel::where('product_title', $item['name'])->first();
                $product->product_quantity = $product->product_quantity - $item['quantity'];
                $product->save();
                $orderItem = new OrderItemModel();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $product->product_id;
                $orderItem->quantity = $item['quantity'];
                $orderItem->price = $item['quantity'] * $item['price'];
                $orderItem->save();
            }

            // Destroy cart when checkout success
            $this->destroyCart($request);

        }


        return redirect('/checkout/alert');

    }
}
