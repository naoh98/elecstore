@extends("backend.layouts.main")
@section("title","Product management")
@section("content")
    <div class="cf_del_pro">
        <p>This product will be permanently removed from the whole system</p>
    </div>
    <div class="container-fluid">
        <div>
            <a href="{{url("/admin/product/create")}}" class="btn btn-success">Add New Product</a>
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        <br>
        <table class="table qlproduct">
            <thead class=" thead-dark">
            <tr>
                <th>Product</th>
                <th>Brand</th>
                <th>Quantity</th>
                <th>Category</th>
                <th>Main Image</th>
                <th>Price Sell</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                <?php
                foreach($product as $products){ ?>
                   <tr>
                       <td>
                           <ul>
                               <li>{{$products->product_title}}</li>
                               <li>Review:
                                   <?php
                                   $point_avg = 0;
                                   if ($products->product_total_point && $products->product_total_post){
                                       $point_avg = round($products->product_total_point / $products->product_total_post,1);
                                   }
                                    for ($i=1;$i<=5;$i++){ ?>
                                       <i class="fa fa-star {{$i <= $point_avg ? 'star_active':''}}"></i>
                              <?php }
                                   ?>
                                   <span style="margin-left: 5px;"><?php echo $point_avg; ?></span>
                               </li>
                           </ul>
                       </td>
                       <td>{{$products->manufacturer_name}}</td>
                       <td>{{$products->product_quantity}}</td>
                       <td class="catname">
                           <?php
                           if ($products->category_name){ ?>
                                {{$products->category_name}}
                   <?php   }else{ ?>
                                <p style="color: red;"><?php echo 'Không xác định'; ?></p>
                   <?php   } ?>
                       </td>
                       <td>
                           <?php
                           if ($products->product_main_image){ ?>
                               <img src="{{asset('/storage/files/'.basename($products->product_main_image))}}" style="margin: 0px auto;max-height: 150px;max-width: 80px;width: auto; height: auto;">
                    <?php  }
                           ?>
                       </td>
                       <?php $price= number_format($products->product_price_sell ,0,',','.'); ?>
                       <td><?php echo $price. ' $'?></td>
                       <td style="text-align: right;">
                           <a href="{{url("/admin/product/edit/$products->product_id")}}" class="btn btn-warning" style="width: 43px;">
                               <i class="fas fa-edit"></i>
                           </a>
                           <form class="del_pro" action="{{url("/admin/product/delete/$products->product_id")}}" method="post" style="display: inline;">
                               @method('delete')
                               @csrf
                               <button class="btn btn-danger" style="width: 43px" type="submit">
                                   <i class="fa fa-trash"></i>
                               </button>
                           </form>
                       </td>
                   </tr>

            <?php }
                ?>
            </tbody>
        </table>
        <div class="row pages">
            {{ $product->links() }}
        </div>
    </div>

@endsection