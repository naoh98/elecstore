@extends("backend.layouts.main")
@section("title","Add new category")
@section("content")
    <div class="container-fluid">
        <div class="row">
            <h1>Add New Category</h1>
            <div class="col-md-12">
                <a href="{{url('/admin/product_category')}}" class="btn btn-info">Back</a>
            </div>
            <br><br>
            <div class="col-md-12">
                <form name="up_cat" action="{{url("/admin/product_category/create")}}"  method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label>Category</label>
                        <input type="text" value="" name="category_name" class="form-control">
                    </div>
                    @error('category_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label style="display: block;">Main Image</label>
                        <label class="custom_img">
                            <input type="file" value="" name="category_image">
                            <span><i class="fa fa-upload"></i>&nbsp;&nbsp;Choose A File</span>
                        </label>
                    </div>
                    @error('category_image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Parent Category</label>
                        <div>
                            <select name="parent_id">
                                <option value="0">None</option>
                                <?php viewcreate($category); ?>
                            </select>
                        </div>
                    </div>
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {!! session('error') !!}
                        </div>
                    @endif
                    <button type="submit" class="btn btn-danger">Add</button>
                </form>
            </div>
        </div>
    </div>

    <?php
    function viewcreate(&$categories,$parent_id=0,$char=""){
    foreach ($categories as $key => $manage){
    if ($manage['parent_id']==$parent_id){
    ?>
    <option value="{{$manage->category_id}}"}}><?php echo $char.$manage['category_name']; ?></option>
    <?php
    unset($categories[$key]);
    viewcreate($categories,$manage['category_id'],$char.$manage['category_name'].' > ');
    }
    }
    }
    ?>
@endsection