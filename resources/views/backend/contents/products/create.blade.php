
@extends("backend.layouts.main")
@section("title","Add new product")
@section("content")
    <div class="container-fluid">
        <div class="row">
            <h1>Add New Product</h1>
            <div class="col-md-12">
                <a href="{{url('/admin/product')}}" class="btn btn-info">Back</a>
            </div>
            <br><br>
            <div class="col-md-12">
                <form name="up_pro" action="{{url("/admin/product/create")}}"  method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" value="" name="product_title" class="form-control">
                    </div>
                    @error('product_title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label style="display: block;">Main Image</label>
                        <label class="custom_img">
                            <input type="file" value="" name="product_main_image">
                            <span><i class="fa fa-upload"></i>&nbsp;&nbsp;Choose A File</span>
                        </label>
                    </div>
                    @error('product_main_image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
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
                                <input type="file" value="" name="product_images[]">
                                <span><i class="fa fa-upload"></i>&nbsp;&nbsp;Choose Files</span>
                            </label>
                        </div>
                        <div>
                        </div>
                    </div>
                    @error('product_images')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Information</label>
                        <textarea name="product_desc" cols="40" rows="20" class="form-control"></textarea>
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
                                    <option value="{{$partner->manufacturer_id}}">{{$partner->manufacturer_name}}</option>
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
                        <input type="text" value="" name="product_quantity" class="form-control">
                    </div>
                    @error('product_quantity')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Price Core</label>
                        <input type="text" value="" name="product_price_core" class="form-control">
                    </div>
                    @error('product_price_core')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Tax</label>
                        <input type="text" value="" name="product_tax" class="form-control">
                    </div>
                    @error('product_tax')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>Category</label>
                        <div>
                            <select name="product_type">
                                <?php
                                foreach ($category as $value){ ?>
                                <option value="{{$value->category_id}}">
                                    <?php  echo $value->category_name  ?>
                                </option>
                                <?php     }
                                ?>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-danger">Add</button>
                </form>
            </div>
        </div>
    </div>
@endsection