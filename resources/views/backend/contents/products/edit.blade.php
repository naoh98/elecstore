@extends("backend.layouts.main")
@section("title","Update product")
@section("content")
    <div class="container-fluid">
        <div class="row">
            <h1>Update Product</h1>
            <div class="col-md-12">
                <a href="{{url('/admin/product')}}" class="btn btn-info">Back</a>
            </div>
            <br><br>
            <div class="col-md-12">
                <form name="up_pro" action="{{url("/admin/product/edit/$product->product_id")}}"  method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group info_social">
                        <div>
                            <label>ID: </label>
                            <span>{{$product->product_id}}</span>
                        </div>
                        <div>
                            <label>Total Reviews: </label>
                            <span>{{$product->product_total_post}}</span>
                        </div>
                        <div>
                            <label>Total point: </label>
                            <span>{{$product->product_total_point}}</span>
                        </div>
                        <div>
                            <?php
                            $point_avg = 0;
                            if ($product->product_total_point && $product->product_total_post){
                                $point_avg = round($product->product_total_point / $product->product_total_post,1);
                            }
                            ?>
                            <label>Average Point: </label>
                            <span>
                                <?php
                                    for ($i=1;$i<=5;$i++){ ?>
                                    <i class="fa fa-star {{$i <= $point_avg ? 'star_active':''}}"></i>
                                    <?php }
                                    ?>
                            </span>
                            <span>{{$point_avg}}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" value="{{$product->product_title}}" name="product_title" class="form-control">
                    </div>
                    @error('product_title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label style="display: block;">Main Image</label>
                        <label class="custom_img">
                            <input type="file" value="{{$product->product_main_image}}" name="product_main_image">
                            <span><i class="fa fa-upload"></i>&nbsp;&nbsp;Choose A File</span>
                        </label>
                    </div>
                    <div class="text-center">
                        <?php if($product->product_main_image){ ?>
                            <img src="{{asset('storage/files/' .basename($product->product_main_image))}}" alt="">
                        <?php } ?>
                    </div>
                    @error('product_main_image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <div class="form-group">
                            <label style="display: block;">Image Collection
                                <span style="margin-left: 10px;">
                                    <button class="btn btn-success add_images" type="button"  style="border-radius: 50%;">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </span>
                            </label>
                            <div class="group_imgs">
                                <label class="custom_img" id="clone_images">
                                    <input type="file" value="{{$product->product_images}}" name="product_images[]">
                                    <span><i class="fa fa-upload"></i>&nbsp;&nbsp;Choose Files</span>
                                </label>
                            </div>
                            <div>
                            </div>
                        </div>
                        <div class="text-center">
                            <?php
                            $data = json_decode($product->product_images);


                            if(is_array($data)){
                            foreach($data as $image){ ?>
                            <img src="{{asset('storage/files/' .basename($image))}}" alt="">
                            <?php }
                            } ?>
                        </div>
                    </div>
                    @error('product_images')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Information</label>
                        <textarea name="product_desc" cols="40" rows="20" class="form-control">{{$product->product_desc}}</textarea>
                    </div>
                    @error('product_desc')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Brand</label>
                        <div>
                            <select name="product_manufacturer">
                                <?php
                                foreach ($fact as $partner){ ?>
                                    <option value="{{$partner->manufacturer_id}}" {{($product->product_manufacturer == $partner->manufacturer_id) ? "selected" : ""}}>
                                    {{$partner->manufacturer_name}}
                                    </option>
                              <?php  }
                                ?>
                            </select>
                        </div>
                    </div>
                    @error('product_manufacturer')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="text" value="{{$product->product_quantity}}" name="product_quantity" class="form-control">
                    </div>
                    @error('product_quantity')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Price Core</label>
                        <input type="text" value="{{$product->product_price_core}}" name="product_price_core" class="form-control">
                    </div>
                    @error('product_price_core')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Tax</label>
                        <input type="text" value="{{$product->product_tax}}" name="product_tax" class="form-control">
                    </div>
                    @error('product_tax')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>Category</label>
                        <div>
                            <select name="product_type">
                                <option value="-1" {{($product->product_type == -1) ? "selected" : ""}}>Unknown</option>
                                <?php
                                foreach ($category as $value){ ?>
                                <option value="{{$value->category_id}}" {{($value->category_id == $product->product_type) ? "selected" : ""}}>
                                    <?php  echo $value->category_name  ?>
                                </option>
                                <?php     }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Attributes
                            <span style="margin-left: 10px;">
                                    <button class="btn btn-success add_product_att" type="button"  style="border-radius: 50%;">
                                        <i class="fa fa-plus"></i>
                                    </button>
                            </span>
                        </label>
                        <table class="att_tbl">
                            <tr id="product_att_clone" style="display: none;">
                                <td>
                                    <select>

                                        <?php
                                        foreach ($att_all as $att){ ?>
                                            <option value="{{$att->attribute_id}}">{{$att->attribute_name}}</option>
                                 <?php  }
                                        ?>
                                    </select>
                                </td>
                                <td><input type="text" value="" class="form-control"></td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php
                        foreach ($product_att as $key=> $item){  ?>
                                <tr>
                                    <td><label>{{$item->attribute_name}}</label></td>
                                    <td><input type="text" value="{{$item->value}}" name="edit_value[]" class="form-control"></td>
                                    <td><a class="att_action"><i class="fa fa-window-close"></i></a></td>
                                    <td><input type="hidden" value="{{$item->id}}" name="id[]" class="form-control"></td>
                                </tr>
                 <?php   }
                        ?>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-danger">Update</button>
                </form>
            </div>
        </div>
    </div>

@endsection
