@extends('frontend.layouts.main')
@section('title','Giỏ hàng')
@section('content')
    <div class="cart-wrapper">
        <div class="cart mt-4 delete_cart_url" data-url="{{route('deleteCart')}}">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-4">
                        @if( !session()->get('cart'))
                            <div class="cart__empty">
                                <h2 class="cart__title">Your cart is empty !</h2>
                                <div class="cart__image"><img src="{{ asset('electronic_store') }}/images/cart-empty.png" alt="" class="img-responsive">

                                </div>
                                <a href="{{ url('/shop-category') }}" class="btn btn-warning">Purchase some products now ?</a>
                            </div>
                        @else
                            <table class="table mt-3 table-striped update_cart_url" data-url="{{route('updateCart')}}">

                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                                @php
                                $total = 0;
                                @endphp
                                @foreach($carts as $key => $cartItem)
                                    <tr>

                                    @php
                                        $total += $cartItem['price'] * $cartItem['quantity'];
                                    @endphp
                                    <th scope="row">
                                        {{$key}}
                                    </th>
                                    <td>
                                        <img style="width: 150px;" src="{{asset('/storage/files/' . basename($cartItem['image']))}}" alt="image">
                                    </td>
                                    <td>{{ $cartItem['name'] }}</td>
                                    <td>{{ number_format($cartItem['price']) }} $</td>
                                    <td>
                                        <input type="number" value="{{ $cartItem['quantity'] }}" min="1" class="quantity" />
                                    </td>
                                    <td>{{ number_format($cartItem['price'] * $cartItem['quantity']) }} $</td>
                                    <td>
                                        <a href="" data-id="{{$key}}" class="btn btn-primary update-cart">Update</a>
                                        <a href="" data-id="{{$key}}" class="btn btn-warning delete-cart">Delete</a>
                                    </td>
                                </tr>
                                 @endforeach

                            </tbody>
                        </table>
                            <h2 style="text-align: right;margin-bottom: 30px"> Total: {{number_format($total)}} $</h2>
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-6">

                        <h2 style="text-align: left"><a href="{{route('homepage')}}" class="btn btn-warning"> <i class="fa fa-long-arrow-left"></i> Continue Shopping ? </a></h2>

                    </div>
                    <div class="col-md-6 text-right">

                        @auth
                            <h2><a href="{{route('checkout.index')}}" class="btn btn-success">Proceed to checkout <i class="fa fa-long-arrow-right"></i></a></h2>
                        @endauth
                        @guest
                                <h2 style="text-align: right"><a href="#" data-toggle="modal" data-target="#myModal88" class="btn btn-success">Proceed to checkout <i class="fa fa-long-arrow-right"></i></a></h2>
                            @endguest
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>


<script type="text/javascript">

    function updateCart(e) {
        e.preventDefault();
       let urlUpdate = $('.update_cart_url').data('url');
       let id = $(this).data('id');
       let quantity = $(this).parents('tr').find('input.quantity').val();
       let  card_number = $('.cart__number');


       $.ajax({
           type: "GET",
           url: urlUpdate,
           data: {id: id, quantity: quantity},
           success: function (data) {
               console.log(data);
               if (data.code === 200) {
                   {{--card_number.text({{coun}})--}}
                    $('body').html(data.cart_view);
                   alert('Update cart success !');
                    return;

               }

           },
           error: function () {

           }

       });
    }

    function deleteCart(e) {
        e.preventDefault();

        let urlDelete = $('.delete_cart_url').data('url');
        let id = $(this).data('id');

        if(confirm('Are you sure want to delete ?')) {
            $.ajax({
                type: "GET",
                url: urlDelete,
                data: {id: id},
                success: function (data) {
                    console.log(data);
                    if (data.code === 200) {
                        $('body').html(data.cart_view);
                    }

                },
                error: function () {

                }

            });
        }


    }
   $(function () {
       $(document).on('click', '.update-cart', updateCart);
       $(document).on('click', '.delete-cart', deleteCart);
   })

</script>
@endsection
