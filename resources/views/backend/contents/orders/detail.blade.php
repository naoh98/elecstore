@extends('backend.layouts.main')


@section('title', 'Order details')

@section('content')

    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-sm-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Order detail</h6>
                    <a href="{{ url('/admin/orders') }}" class="m-0 font-weight-bold text-primary">Back</a>
                </div>
                <div class="card-body">
                    <!-- Table Order product here -->
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">Order_ID</th>
                            <th scope="col">Product_ID</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Date</th>

                        </tr>
                        </thead>
                        <tbody>
                        @if($order_items)
                            @foreach($order_items as $item)
                                <tr>
                                    <th scope="row">{{$item->order_id}}</th>
                                    <td>{{$item->product_id}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$item->price}}</td>
                                    <td>{{date('d/m/Y H:i:s', strtotime($item->created_at))}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <!-- Table Order product here -->

                </div>
            </div>
            <!-- Project Card Example -->

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-sm-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Product</h6>
                </div>
                <div class="card-body">
                    <!-- Table product here -->
                    <table class="table qlproduct">
                        <thead class=" thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Product</th>
                            <th>Manufacturer</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Price sell</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->product_id }}</td>
                            <td>
                                <ul>
                                    <li>{{$product->product_title}}</li>
                                    <li>Reviews:
                                        <?php
                                        $point_avg = 0;
                                        if ( $product->product_total_point && $product->product_total_post ){
                                            $point_avg = round($product->product_total_point / $product->product_total_post,1);
                                        }
                                        for ($i=1;$i<=5;$i++){ ?>
                                        <i class="fa fa-star {{$i <= $point_avg ? 'star_active':''}}"></i>
                                        <?php }
                                        ?>
                                        <span style="margin-left: 5px;"><?php echo $point_avg; ?></span>
                                    </li>
                                </ul>
                            </td>
                            <td>{{$product->manufacturer_name}}</td>
                            <td class="catname">
                                <?php
                                if ($product->category_name){ ?>
                                {{$product->category_name}}
                                <?php   }else{ ?>
                                <p style="color: red;"><?php echo 'Unknown'; ?></p>
                                <?php   } ?>
                            </td>
                            <td>
                                <?php
                                if ($product->product_main_image){ ?>
                                <img src="{{asset('/storage/files/'.basename($product->product_main_image))}}" style="margin: 0px auto;max-height: 150px;max-width: 80px;width: auto; height: auto;">
                                <?php  }
                                ?>
                            </td>
                            <?php $price= number_format($product->product_price_sell ,0,',','.'); ?>
                            <td><?php echo $price. ' $'?></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!-- Table product here -->
                </div>
            </div>
            <!-- Project Card Example -->
        </div>

    </div>

@endsection



