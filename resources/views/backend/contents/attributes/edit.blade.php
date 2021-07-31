@extends("backend.layouts.main")
@section("title","Update Attribute")
@section("content")
    <div class="container-fluid">
        <div class="row">
            <h1>Update Attribute</h1>
            <div class="col-md-12">
                <a href="{{url('/admin/attribute')}}" class="btn btn-info">Back</a>
            </div>
            <br><br>
            <div class="col-md-12">
                <form name="up_att" action="{{url("/admin/attribute/edit/$att->attribute_id")}}"  method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label>Attribute Name</label>
                        <input type="text" value="{{$att->attribute_name}}" name="attribute_name" class="form-control">
                    </div>
                    @error('attribute_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="btn btn-danger">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
