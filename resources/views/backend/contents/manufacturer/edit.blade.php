@extends("backend.layouts.main")
@section("title","Update Brand")
@section("content")
    <div class="container-fluid">
        <div class="row">
            <h1>Update Brand</h1>
            <div class="col-md-12">
                <a href="{{url('/admin/manufacturer')}}" class="btn btn-info">Back</a>
            </div>
            <br><br>
            <div class="col-md-12">
                <form name="up_fact" action="{{url("/admin/manufacturer/edit/$fact->manufacturer_id")}}"  method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label>ID: </label>
                        <span>{{$fact->manufacturer_id}}</span>
                    </div>
                    <div class="form-group">
                        <label>Brand</label>
                        <input type="text" value="{{$fact->manufacturer_name}}" name="manufacturer_name" class="form-control">
                    </div>
                    @error('manufacturer_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label style="display: block;">Main Image</label>
                        <label class="custom_img">
                            <input type="file" value="{{$fact->manufacturer_image}}" name="manufacturer_image">
                            <span><i class="fa fa-upload"></i>&nbsp;&nbsp;Choose A File</span>
                        </label>
                    </div>
                    <div class="text-center">
                        <?php if($fact->manufacturer_image){ ?>
                        <img src="{{asset('storage/files/' .basename($fact->manufacturer_image))}}" alt="" >
                        <?php } ?>
                    </div>
                    @error('manufacturer_image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label>Information</label>
                        <textarea name="manufacturer_desc" cols="40" rows="20" class="form-control">{{$fact->manufacturer_desc}}</textarea>
                    </div>
                    @error('manufacurer_desc')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <button type="submit" class="btn btn-danger">Update</button>
                </form>
            </div>
        </div>
    </div>




    <?php
    function viewedit(&$categories,$products,$parent_id=0,$char=""){
    foreach ($categories as $key => $manage){
    if ($manage->parent_id==$parent_id){
    ?>
    <option value="{{$manage->category_id}}" {{($manage->category_id == $products->product_type) ? "disabled" : ""}}><?php echo $char.$manage->category_name.' ['.$manage->category_id.']'; ?></option>
    <?php
    unset($categories[$key]);
    viewedit($categories,$products,$manage->category_id,$manage->category_name.' ['.$manage->category_id.']'.' > ');
    }
    }
    }
    ?>
@endsection
