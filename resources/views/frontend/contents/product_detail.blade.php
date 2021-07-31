@extends('frontend.layouts.main')
@section('title',$product->product_title)
@section('content')
    <div class="banner banner3"
         style="background: url('{{asset('/storage/files/'.basename($product->category_image))}}')no-repeat center;background-size: 100% 100%;">
    </div>
    <!-- //banner -->
    <!-- breadcrumbs -->
    <div class="breadcrumb_dress">
        <div class="container-fluid">
            <ul>
                <li><a href="{{url('/')}}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a> <i>/</i></li>
                <li>Product Detail<i>/</i></li><li>{{$product->product_title}}</li>
            </ul>
        </div>
    </div>
    <!-- //breadcrumbs -->
    <!-- single -->
    <div class="single" style="padding-bottom: 3em;">
        <div class="container">
            <div class="col-md-5 single-left">
                <div class="flexslider">
                    <ul class="slides">
                        <?php
                        if ($product->product_images){
                            $data = json_decode($product->product_images);
                            foreach ($data as $image){ ?>
                            <li data-thumb="{{asset('/storage/files/'.basename($image))}}">
                                <div class="thumb-image"> <img src="{{asset('/storage/files/'.basename($image))}}" data-imagezoom="true" class="img-responsive" alt=""> </div>
                            </li>
                  <?php     }
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-7 single-right">
                <h3 style="text-align: center;">{{$product->product_title}}</h3>
                <div class="description">
                    <div>
                        <label>Category: </label>
                        <span><a href="{{route('cat.pro',['category_id'=>$product->category_id])}}">{{$product->category_name}}</a></span>
                    </div>
                    <div class="rating-avg">
                        <?php
                        $point_avg = 0;
                        if ($product->product_total_point && $product->product_total_post){
                            $point_avg = round($product->product_total_point / $product->product_total_post,1);
                        }
                        ?>
                        <b><?php echo $point_avg; ?></b>
                        <span class="fa fa-star"></span>
                    </div>
                    <div>
                        <label>Brand: </label>
                        <span><a href="{{route('cat.pro.all',['manu'=>$product->manufacturer_id])}}">{{$product->manufacturer_name}}</a></span>
                    </div>
                </div>
                <div class="occasional">
                    <div style="margin-bottom: 20px;">
                        <p>{{$product->product_desc}}</p>
                    </div>
                    <h5>Technical Specification</h5>
                    <?php
                        if (count($attributes)<=0){ ?>
                            <div>
                                <p style="color: grey;">There is currently no information for this product yet.</p>
                            </div>
                 <?php  }else{
                    foreach ($attributes as $attribute){ ?>
                    <div style="width: 48%; float: left;margin-left: 5px;">
                        <label>{{$attribute->attribute_name}}:</label>
                        <span>{{$attribute->value}}</span>
                    </div>
            <?php   }
               }
                    ?>
                    <div class="clearfix"> </div>
                </div>
                <div class="simpleCart_shelfItem" style="display: flex; justify-content: center;">
                    <?php $price= number_format($product->product_price_sell ,0,',','.'); ?>
                    <p style="margin: 5px 20px 0px 0px;font-size: 18px;"><i class="item_price"><?php echo $price.' $'; ?></i></p>
                        <a href="#" data-url="{{ route('addToCart', ['id' => $product->product_id]) }}" class="btn btn-primary add_to_cart">Add to cart</a>

                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>

    <div class="additional_info" style="padding-top: 3em;">
        <div class="container">
            <div class="sap_tabs">
                <div id="horizontalTab1" style="display: block; width: 100%; margin: 0px;">
                    <ul>
                        <li class="resp-tab-item" aria-controls="tab_item-0" role="tab"><span>About Brand</span></li>
                        <li class="resp-tab-item" aria-controls="tab_item-1" role="tab"><span>Review</span></li>
                    </ul>
                    <div class="tab-1 resp-tab-content additional_info_grid" aria-labelledby="tab_item-0">
                            <h3>{{$product->manufacturer_name}}</h3>
                            <p class="col-md-9">{{$product->manufacturer_desc}}</p>
                            <?php
                            if ($product->manufacturer_image){ ?>
                                <img class="col-md-3" src="{{asset('/storage/files/'.basename($product->manufacturer_image))}}" style="height: 180px; " >
                    <?php   }
                            ?>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="tab-2 resp-tab-content additional_info_grid" aria-labelledby="tab_item-1">
                        <h4>({{$product->product_total_post ? $product->product_total_post:0}}) Reviews</h4>
                        <div class="post_content">
                            <?php
                            foreach ($rate_list as $post){ ?>
                            <div class="additional_info_sub_grids">
                                <div class="col-xs-2 additional_info_sub_grid_left">
                                    <?php
                                    for ($i=1;$i<=5;$i++){ ?>
                                    <i class="fa fa-star {{$i <= $post->rate_point ? 'star_active':''}}"></i>
                                    <?php } ?>
                                </div>
                                <div class="col-xs-10 additional_info_sub_grid_right">
                                    <div class="additional_info_sub_grid_rightl">
                                        <h5>{{$post->name}}</h5>
                                        <p>{{$post->post}}</p>
                                    </div>
                                    <div class="additional_info_sub_grid_rightr">
                                        <h5>{{$post->updated_at ? $post->updated_at.' (đã sửa)' : $post->created_at}}</h5>
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <hr style="border: 1px solid darkgrey;">
                            <?php  }
                            ?>
                        </div>
                        <div style="text-align: center;">
                            <button class="btn btn-success loadmore_post" {{$product->product_total_post ? '':'disabled'}}>See more</button>
                            <h5 class="alert_outofdata" style="display: none;"><i>No review left !</i></h5>
                        </div>
                        <div class="review_grids">
                            <h5>Add a review for this product</h5>
                            <?php
                            if (!$rating){ ?>
                            <form class="product_rate_form">
                                <div class="rating1" style="font-size: 20px;">
                                    <span class="listRate">
                                    <?php
                                        for ($i=1;$i<=5;$i++){ ?>
                                        <i class="fa fa-star" data-key="{{$i}}"></i>
                                        <?php } ?>
                                    </span>
                                    <span class="listRatingText" style="display: none;"></span>
                                </div>
                                <div class="error_rate_point" style="color: red; font-style: italic;margin-bottom: 1em;"></div>
                                <textarea name="review"></textarea>
                                <div class="error_review" style="color: red; font-style: italic;margin-bottom: 0.8em;"></div>
                                <input type="hidden" name="user_id" value="{{auth()->check() ? auth()->user()->id : ''}}">
                                <input type="hidden" name="rate_point" value="" class="point_rating">
                                <input type="submit" class="submit_rate" value="Gửi" >
                            </form>
                     <?php  }else{ ?>
                            <i style="color: grey;display: block;text-align: center;">You have been reviewed this product. <a class="edit_review" href="#">Edit</a></i>
                            <form class="product_rate_form_edit" style="position: relative;padding: 15px;">
                                <div class="rating1" style="font-size: 20px;">
                                    <span class="listRate_edit">
                                    <?php
                                        for ($i=1;$i<=5;$i++){ ?>
                                        <i class="fa fa-star {{$i <= $rating->rate_point ? 'star_active_click':''}}" data-key="{{$i}}"></i>
                                        <?php } ?>
                                    </span>
                                    <span class="listRatingText" style="display: none;"></span>
                                </div>
                                <textarea name="review">{{$rating->post}}</textarea>
                                <div class="error_edit_review" style="color: red; font-style: italic;margin-bottom: 0.8em;"></div>
                                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                <input type="hidden" name="rate_point" value="{{$rating->rate_point}}" class="point_rating">
                                <input type="hidden" name="old_rate_point" value="{{$rating->rate_point}}">
                                <input type="submit" class="submit_rate" value="Update">
                                <div class="after_form"></div>
                            </form>
                     <?php  }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
            <script src="{{asset('/electronic_store')}}/js/easyResponsiveTabs.js" type="text/javascript"></script>
            <script type="text/javascript">
                $(document).ready(function () {
                    $('#horizontalTab1').easyResponsiveTabs({
                        type: 'default', //Types: default, vertical, accordion
                        width: 'auto', //auto or any width like 600px
                        fit: true   // 100% fit in a container
                    });
                });
            </script>
        </div>
    </div>

    <div class="user_only">
        <div class="user_login_req">
            <p>You can not leave review now. Please login first.</p>
            <div class="log_option_req">
                <button class="btn btn-primary redirect_user_only">Oh! Why not ?</button>
                <button class="btn btn-primary close_user_only">Maybe later.</button>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <div class="w3l_related_products">
        <div class="container">
            <h3>Related Products</h3>
            <ul id="flexiselDemo2">
                <?php
                foreach ($related_pros as $related_pro){ ?>
                    <li>
                        <div class="w3l_related_products_grid">
                            <div class="agile_ecommerce_tab_left mobiles_grid">
                                <div class="hs-wrapper hs-wrapper3">
                                    <?php
                                    if ($related_pro->product_images){
                                        $data = json_decode($related_pro->product_images);
                                        foreach ($data as $image){ ?>
                                        <img src="{{asset('/storage/files/'.basename($image))}}" alt=" " class="img-responsive" />
                             <?php      }
                                    }
                                    ?>
                                    <div class="w3_hs_bottom">
                                        <div class="flex_ecommerce">
                                            <a style="display: block; border-radius: 7px; width: 50%; margin: 0px auto;" href="{{url('/product/'.$related_pro->product_id)}}"><span>Detail</span></a>
                                        </div>
                                    </div>
                                </div>
                                <h5><a href="{{url('/product/'.$related_pro->product_id)}}">{{$related_pro->product_title}}</a></h5>
                                <div class="simpleCart_shelfItem">
                                    <?php $price= number_format($related_pro->product_price_sell ,0,',','.'); ?>
                                    <p class="flexisel_ecommerce_cart"><i class="item_price"><?php echo $price. ' $'; ?></i></p>
                                        <a href="#" data-url="{{ route('addToCart', ['id' => $related_pro->product_id]) }}" class="btn btn-primary add_to_cart">Add to cart</a>

                                </div>
                            </div>
                        </div>
                    </li>
          <?php }
                ?>
            </ul>

            <script type="text/javascript">
                $(window).load(function() {
                    $("#flexiselDemo2").flexisel({
                        visibleItems:4,
                        animationSpeed: 1000,
                        autoPlay: true,
                        autoPlaySpeed: 3000,
                        pauseOnHover: true,
                        enableResponsiveBreakpoints: true,
                        responsiveBreakpoints: {
                            portrait: {
                                changePoint:480,
                                visibleItems: 1
                            },
                            landscape: {
                                changePoint:640,
                                visibleItems:2
                            },
                            tablet: {
                                changePoint:768,
                                visibleItems: 3
                            }
                        }
                    });

                });
            </script>
        </div>
    </div>
    <!-- //Related Products -->

    <!-- flexslider -->
    <script defer src="{{asset('/electronic_store')}}/js/jquery.flexslider.js"></script>
    <link rel="stylesheet" href="{{asset('/electronic_store')}}/css/flexslider.css" type="text/css" media="screen" />
    <script>
        // Can also be used with $(document).ready()
        $(window).load(function() {
            $('.flexslider').flexslider({
                animation: "slide",
                controlNav: "thumbnails"
            });
        });
    </script>
    <!-- flexslider -->

    <!-- zooming-effect -->
    <script src="{{asset('/electronic_store')}}/js/imagezoom.js"></script>
    <!-- //zooming-effect -->

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {
            var star = $('.listRate .fa');
            var star_edit = $('.listRate_edit .fa');
            var listRatingText = {
                1 : 'Bad',
                2 : 'Acceptable',
                3 : 'Quite Good',
                4 : 'Great',
                5 : 'Perfect'
            };
            star.on('click', function () {
                var number = $(this).attr('data-key');
                $('.point_rating').val(number);
                $.each(star, function (key,value) {
                    if (key+1 <= number){
                        $(this).addClass('star_active_click');
                    }else{
                        $(this).removeClass('star_active_click');
                    }
                });
            });
            //
            star_edit.on('click', function () {
                var number = $(this).attr('data-key');
                $('.point_rating').val(number);
                $.each(star_edit, function (key,value) {
                    if (key+1 <= number){
                        $(this).addClass('star_active_click');
                    }else{
                        $(this).removeClass('star_active_click');
                    }
                });
            });
            //
            star.on('mouseover', function () {
                var number = $(this).attr('data-key');
                $.each(star, function (key,value) {
                   if (key+1 <= number){
                       $(this).addClass('star_active');
                   }
                });
                $('.listRatingText').text(listRatingText[number]).show();
            });
            //
            star.on('mouseout', function () {
                $('.listRatingText').text('').hide();
                star.removeClass('star_active');
            });
            //
            $('.product_rate_form').on('submit', function (event) {
                event.preventDefault();
                $('.error_rate_point').html('');
                $('.error_review').html('');
                var data ={};
                data.user_id= $('input[name="user_id"]').val();
                data.rate_point= $('input[name="rate_point"]').val();
                data.review= $('textarea[name="review"]').val();
                if (data.user_id){
                    if (data.rate_point == '' || data.rate_point == null){
                        $('.error_rate_point').html('Don\'t you forget to give this product some stars ? !');
                        return false;
                    }else if (data.review == '' || data.review == null){
                        $('.error_review').html('Please let us know your opinion about this product !');
                        return false;
                    }else{
                        $.ajax({
                            url: "{{route('rate',$product->product_id)}}",
                            data: data,
                            type: 'POST',
                            dataType: 'json',
                            beforeSend: function() {

                            },
                            success: function(res){
                                if (res.code == 200){
                                    alert('Successfully send review');
                                    location.reload();
                                }
                            },
                            error: function(res) {
                                console.log(res);
                            },
                            complete: function() {

                            }
                        });
                    }
                }else{
                    $('.user_only').css(
                        {'visibility':'visible',
                            'opacity':'1',
                            'z-index':'1001',
                            'position':'fixed'
                        });
                    return false;
                }

            });
            //
            $('.redirect_user_only').on('click', function () {
               $('.user_only').css('visibility','hidden');
               $('#myModal88').modal('show');
            });
            //
            $('.close_user_only').on('click', function () {
                $('.user_only').css('visibility','hidden');
            });
            //
            $('.edit_review').on('click', function (event) {
                event.preventDefault();
                $('.after_form').css('visibility','hidden');
            });
            //
            $('.product_rate_form_edit').on('submit', function (event) {
                event.preventDefault();
                $('.error_edit_review').html('');
                var data ={};
                data.user_id= $('input[name="user_id"]').val();
                data.rate_point= $('input[name="rate_point"]').val();
                data.review= $('textarea[name="review"]').val();
                data.old_rate_point= $('input[name="old_rate_point"]').val();
                if (data.review == '' || data.review == null){
                    $('.error_edit_review').html('Please let us know your opinion about this product !');
                    return false;
                }else{
                    $.ajax({
                        url: "{{route('rate.edit',$product->product_id)}}",
                        data: data,
                        type: 'POST',
                        dataType: 'json',
                        beforeSend: function() {

                        },
                        success: function(res){
                            if (res.code == 200){
                                alert('Successfully send review');
                                location.reload();
                            }
                        },
                        error: function(res) {
                            console.log(res);
                        },
                        complete: function() {

                        }
                    });
                }
            });
            //
            $('.loadmore_post').on('click', function () {
                var start = $('.additional_info_sub_grids').length;
                var limit = 2;
                var data ={};
                data.start = start;
                data.limit = limit;
                $.ajax({
                 url: "{{route('loadmore',$product->product_id)}}",
                 data: data,
                 type: 'POST',
                 dataType: 'json',
                 beforeSend: function() {

                 },
                 success: function(res){
                     if (res.code==200){
                         $('.post_content').append(res.html);
                     }else{
                         $('.loadmore_post').hide();
                         $('.alert_outofdata').show();
                     }
                 },
                 error: function(res) {
                    console.log(res);
                 },
                 complete: function() {

                 }
                 });

            })
        });

    </script>
@endsection

