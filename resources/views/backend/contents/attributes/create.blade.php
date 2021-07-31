@extends("backend.layouts.main")
@section("title","Add new Attribute")
@section("content")
    <div class="container-fluid">
        <div class="row">
            <h1>Add new attribute</h1>
            <div class="col-md-12">
                <a href="{{url('/admin/attribute')}}" class="btn btn-info">Back</a>
            </div>
            <br><br>
            <div class="col-md-12">
                <form name="cr_att" action="{{url("/admin/attribute/create")}}"  method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label>Attribute name</label>
                        <input type="text" value="" name="attribute_name" class="form-control">
                    </div>
                    @error('attribute_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="btn btn-danger">Add</button>
                </form>
            </div>
        </div>
    </div>
@endsection