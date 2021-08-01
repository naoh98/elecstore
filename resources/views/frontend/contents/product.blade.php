@extends('frontend.layouts.main')
@section('title','Product Category')
@section('content')

    <div class="banner banner3"
            style="background: url('{{asset("/storage/files/".basename($this_cat->category_image))}}') no-repeat center;background-size: 100% 100%;">
    </div>

    <div class="breadcrumb_dress">
        <div class="container-fluid">
            <ul>
                <li><a href="{{url('/')}}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a> <i>/</i></li>
                <li>Product category</li>
            </ul>
        </div>
    </div>

    <div class="mobiles">
        <div class="container">
            <div class="w3ls_mobiles_grids">
                <div class="col-md-4 w3ls_mobiles_grid_left">
                    <div class="w3ls_mobiles_grid_left_grid">
                        <h3>Category</h3>
                        <div class="w3ls_mobiles_grid_left_grid_sub catforpro">
                            <a href="{{url('/shop-category')}}">All</a>
                            <?php showcatforpro($categories, $this_cat); ?>
                        </div>
                    </div>
                    <div class="w3ls_mobiles_grid_left_grid">
                        <h3>Brand</h3>
                        <div class="w3ls_mobiles_grid_left_grid_sub">
                            <div class="ecommerce_manu">
                                <ul>
                                    <?php
                                    foreach ($manufacturer as $manu){ ?>
                                        <li>
                                            <i class="fa fa-cubes" aria-hidden="true"></i>
                                            <a class="searchf_manu {{request()->get('manu')==$manu->manufacturer_id ? 'manu_active' : ''}}"
                                             href="{{ route('cat.pro', ['page'=>1, 'manu'=>$manu->manufacturer_id,'category_id'=>$this_cat->category_id]) }}">
                                                {{$manu->manufacturer_name}}
                                            </a>
                                        </li>
                             <?php  }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 w3ls_mobiles_grid_right">
                    <div class="w3ls_mobiles_grid_right_grid2">

                        <div class="w3ls_mobiles_grid_right_grid2_left cat_title">
                            <h2>{{$this_cat->category_name}}
                            <?php
                            foreach ($manufacturer as $manu){
                                if (request()->get('manu')==$manu->manufacturer_id){
                                    echo ' <i class="fa fa-angle-double-right" aria-hidden="true"></i> '.$manu->manufacturer_name;
                                }else{
                                    echo '';
                                }
                            }
                            ?>
                            </h2>
                            <div class="cat_title_de"></div>
                        </div>

                        <div class="w3ls_mobiles_grid_right_grid2_right">
                            <select name="select_item" class="select_item product_filter">
                                <option value="all">Default</option>
                                <option value="lastest" {{request()->get('sortby')=='lastest' ? 'selected':''}}>Lastest</option>
                                <option value="price_desc" {{request()->get('sortby')=='price_desc' ? 'selected':''}}>Price (descending)</option>
                                <option value="price_asc" {{request()->get('sortby')=='price_asc' ? 'selected':''}}>Price (ascending)</option>
                            </select>
                        </div>
                        <div class="clearfix"> </div>
                    </div>

                    <div>
                        <div class="row">
                            <?php
                            if (count($product)>0){
                            foreach ($product as $value){  ?>
                            <div class="col-md-4 agileinfo_new_products_grid agileinfo_new_products_grid_mobiles single_product">
                                <div class="agile_ecommerce_tab_left mobiles_grid">
                                    <div class="hs-wrapper hs-wrapper2">
                                        <?php
                                        if ($value->product_images){
                                        $data = json_decode($value->product_images);
                                        if(is_array($data)){
                                        foreach($data as $image){ ?>
                                        <img src="{{asset('storage/files/' .basename($image))}}" alt="" class="img-responsive" >
                                        <?php }
                                        }
                                        } ?>
                                        <div class="w3_hs_bottom w3_hs_bottom_sub1">
                                            <ul>
                                                <li>
                                                    <a href="{{url('/product/'.$value->product_id)}}"><span>Detail</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <h5><a href="{{url('/product/'.$value->product_id)}}">{{$value->product_title}}</a></h5>
                                    <div class="simpleCart_shelfItem">
                                        <?php $price= number_format($value->product_price_sell ,0,',','.'); ?>
                                        <p><i class="item_price"><?php echo $price.' $'; ?></i></p>
                                            <a href="#" data-url="{{ route('addToCart', ['id' => $value->product_id]) }}" class="btn btn-primary add_to_cart">Add to cart</a>

                                    </div>
                                </div>
                            </div>
                            <?php  }
                            } else{ ?>
                                <h3 style="font-style: italic; color: grey; text-align: center; margin-top: 15px;">No product found !</h3>
                    <?php   }?>
                        </div>
                        <div class="row pages">
                            <?php
                            if (isset($_GET['manu'])){
                                $manu = $_GET['manu'];
                                echo $product->appends(['manu'=>$manu])->links();
                            }else{
                                echo $product->links();
                            }
                            ?>
                        </div>
                    </div>

                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>

    <script>
        $('.product_filter').on('change',function(){
            var value = $(this).val();
            var url = window.location.href;
            var url1 = new URL(url);
            var manu = url1.searchParams.get("manu");
            var sort = url1.searchParams.get("sortby");
            var data = {};
            data.sortby=value;
            if (manu){
                data.manu=manu;
            }

            $.ajax({
                url: '{{ route('filter',$this_cat->category_id) }}/',
                data: data,
                method: 'post',
                beforeSend: function() {

                },
                success: function(res){
                    console.log(res);
                    $('body').html(res);
                },
                error: function(res) {
                    alert('sending data fail');
                    console.log(res);
                },
                complete: function() {

                }
            });

        })
    </script>
@endsection

<?php
function showcatforpro(&$categories, $this_cat,$parent_id = 0,$char='<span></span>'){
$cat_child = [];
foreach ($categories as $key => $item){
    if($item->parent_id==$parent_id){
        $cat_child[] = $item;
        unset($categories[$key]);
    }
}
if ($cat_child){

echo '<ul>';
foreach ($cat_child as $key => $item){?>
<li><?php echo $char; ?><i class="fa fa-arrow-right" aria-hidden="true" style="color: limegreen; margin-right: 8px;"></i>
    <a class="{{$item->category_id==$this_cat->category_id ? 'cat_active' : ''}}" href="{{url('/shop-category/'.$item->category_id)}}">
        <?php
        echo $item->category_name;
        showcatforpro($categories,$this_cat,$item->category_id,$char.'<span style="margin-left: 15px;"></span>');
        ?>
    </a>
</li>
<?php }
echo '</ul>';
}
} ?>
