@extends('frontend.layouts.main')
@section('title','Checkout')
@section('content')
 <div class="checkout-block">
     <div class="container">
         <div class="rơw">
             <div class="col-md-7">
                 <div class="checkout__group">
                 <h2 class="checkout-block__title">Billing Details </h2>
                 <form name="order" action="{{ route('checkout.order') }}" method="post">

                     {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Firstname</label>
                                <input type="text" name="first_name" class="form-control ">

                                @error('first_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input class="form-control" name="last_name" value="">

                                @error('last_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                     <div class="form-group">
                         <label>Payment Method</label>
                         <select name="payment_method" class="form-control">
                             <option value="0">Delivery received money</option>
                             <option value="1">Payment via ATM card</option>
                             <option value="2">Digital wallet MOMO</option>
                             <option value="3">Payment via Mastercard</option>
                         </select>

                     </div>

                     <div class="form-group">
                         <label>Address</label>
                         <input class="form-control" name="address" value="">

                         @error('address')
                         <div class="alert alert-danger">{{ $message }}</div>
                         @enderror
                     </div>
                     <div class="form-group">
                         <label>City</label>
                         <input class="form-control" name="city" value="">

                         @error('city')
                         <div class="alert alert-danger">{{ $message }}</div>
                         @enderror
                     </div>
                     <div class="form-group">
                         <label>Country</label>
                         <input type="text" name="country" class="form-control" value="">

                         @error('country')
                         <div class="alert alert-danger">{{ $message }}</div>
                         @enderror
                     </div>
                     <div class="form-group">
                         <label>Phone number</label>
                         <!-- thêm nhiều file bằng multiple vào thẻ input -->
                         <input type="text" name="phone_number" class="form-control" value="">

                         @error('phone_number')
                         <div class="alert alert-danger">{{ $message }}</div>
                         @enderror

                     </div>
                     <div class="form-group">

                         <label>Note</label>
                         <textarea type="text" name="notes" class="form-control"></textarea>
                     </div>

                     <button type="submit" class="btn btn-success">Place order</button>
                 </form>
                 </div>
             </div>
             <div class="col-md-5">
                 <div class="checkout__group ckright">
                 <h2 class="checkout-block__title">Your order</h2>

                 <div class="summary">
                     @php
                     $total = 0
                     @endphp

                     @foreach($carts as $cart)
                         @php
                            $total += $cart['quantity'] * $cart['price']
                         @endphp

                        <div class="summary__content">
                            <div class="summary__block">
                                <div class="summary__title">{{$cart['name']}} <span class="summary__quantity">x {{$cart['quantity']}}</span></div>
                                <div class="summary__price">{{ $cart['price'] }} $</div>
                            </div>


                        </div>

                     @endforeach
                 </div>
                 <div class="summary-total">Total: <span>{{ number_format($total) }} $</span></div>
                 </div>
             </div>
         </div>
     </div>
 </div>

@endsection
