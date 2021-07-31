
@extends("backend.layouts.main")
@section("title","Edit post")
@section("content")
    <div class="container-fluid">
        <div class="row">
            <h1>Edit post</h1>
            <div class="col-md-12">
                <a href="{{ route('admin.new.index') }}" class="btn btn-info">Back</a>
            </div>
            <br><br>
            <div class="col-md-12">
                <form name="up_pro" action="{{ route('admin.new.update', ['new_id' => $post->id]) }}"  method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" value="{{ $post->title }}" name="title" class="form-control">
                    </div>
                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label style="display: block;">Image</label>
                        <label class="custom_img">
                            <input type="file" value="{{ $post->image }}" name="image">
                            <span><i class="fa fa-upload"></i>&nbsp;&nbsp;Choose file</span>
                        </label>
                    </div>
                    <div class="text-center">
                        <?php
                            if ($post->image) { ?>
                            <img src="{{asset('storage/files/'. basename($post->image))}}" alt="">
                        <?php }
                        ?>
                    </div>
                    @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Excerpt</label>
                        <textarea name="excerpt" cols="40" rows="20" class="form-control">
                            {{ $post->excerpt }}
                        </textarea>
                    </div>
                    @error('excerpt')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label>Content</label>
                        <textarea name="content_post" cols="40" rows="20" class="form-control">
                            {{ $post->content_post }}
                        </textarea>
                    </div>
                    @error('content')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror


                    <button type="submit" class="btn btn-danger">Edit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
