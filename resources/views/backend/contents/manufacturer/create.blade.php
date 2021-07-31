@extends("backend.layouts.main")
@section("title","Add new brand")
@section("content")
    <div class="container-fluid">
        <div class="row">
            <h1>Add New Brand</h1>
            <div class="col-md-12">
                <a href="{{url('/admin/manufacturer')}}" class="btn btn-info">Back</a>
            </div>
            <br><br>
            <div class="col-md-12">
                <form name="up_fact" action="{{url("/admin/manufacturer/create")}}"  method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label>Brand</label>
                        <input type="text" value="" name="manufacturer_name" class="form-control">
                    </div>
                    @error('manufacturer_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label style="display: block;">Main Image</label>
                        <label class="custom_img">
                            <input type="file" value="" name="manufacturer_image">
                            <span><i class="fa fa-upload"></i>&nbsp;&nbsp;Choose A File</span>
                        </label>
                    </div>
                    @error('manufacturer_image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Information</label>
                        <textarea name="manufacturer_desc" cols="40" rows="20" class="form-control"></textarea>
                    </div>
                    @error('manufacurer_desc')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="btn btn-danger">Add</button>
                </form>
            </div>
        </div>
    </div>
@endsection