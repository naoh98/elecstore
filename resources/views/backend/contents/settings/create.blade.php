
@extends("backend.layouts.main")
@section("title","Add new settings")
@section("content")
    <div class="container-fluid">
        <div class="row">
            <h1>Add New Setting</h1>
            <div class="col-md-12">

                <a href="{{url('/admin/settings')}}" class="btn btn-info">Back</a>
            </div>
            <br><br>
            <div class="col-md-8">
                <form name="up_pro" action="{{ route('settings.store') . '?type='. request()->type }}"  method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label>Config key</label>
                        <input type="text" value="" name="config_key" class="form-control" placeholder="Enter you config key">
                    </div>
                    @error('config_key')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @if( request()->type == 'Text')
                    <div class="form-group">
                        <label>Config value</label>
                        <input type="text" value="" name="config_value" class="form-control" placeholder="Enter you config value">
                    </div>
                    @elseif( request()->type == 'Textarea')
                        <div class="form-group">
                            <label>Config value</label>
                            <textarea name="config_value" rows="5"  class="form-control" placeholder="Enter your config value"></textarea>
                        </div>
                    @endif
                    @error('config_value')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <button type="submit" class="btn btn-danger">Add</button>
                </form>
            </div>
        </div>
    </div>
@endsection
