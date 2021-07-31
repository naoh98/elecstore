@extends("backend.layouts.main")
@section("title","Order list management")
@section("content")
   <div class="d-sm-flex">
       <h1 class="h3 mb-0 text-gray-800 mb-3" style="text-align: center;width: 100%">Order</h1>
   </div>
    <div class="container-fluid">
        <table class="table qlproduct">
            <thead class=" thead-dark">
            <tr>
                <th>Order_number</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Address</th>
                <th>City</th>
                <th>Country</th>
                <th>Phone number</th>
                <th>Notes</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

            @foreach($orders as $order)
            <tr>
               <td>{{$order->order_number}}</td>
               <td>{{$order->first_name}}</td>
               <td>{{$order->last_name}}</td>
               <td>{{$order->address}}</td>
               <td>{{$order->city}}</td>
               <td>{{$order->country}}</td>
               <td>{{$order->phone_number}}</td>
               <td>{{$order->notes}}</td>
               <td>
                   <a title="Xem" href="{{url("/admin/orders/item/$order->id")}}" class="btn btn-info"><i class="fa fa-eye"></i></a>
               </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row pages">
            {{ $orders->links() }}
        </div>
    </div>

@endsection
