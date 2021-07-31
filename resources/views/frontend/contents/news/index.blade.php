@extends('frontend.layouts.main')
@section('title','Blog Grid')
@section('content')
    <div class="banner banner3"
         style="background: url({{asset('/electronic_store/images/coffeeflatlay.jpg')}}) no-repeat center;background-size: cover;">
        <div class="decorated_img decorated_img1">
            <span>Lastest news</span>
        </div>
    </div>

    <div class="breadcrumb_dress">
        <div class="container-fluid">
            <ul>
                <li><a href="{{url('/')}}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a> <i>/</i></li>
                <li>News</li>
            </ul>
        </div>
    </div>

    <div class="post-grid">

        <div class="container">
            <div class="row">
                <h2 style="text-align: center;font-size: 35px;margin-bottom: 30px;">Our News</h2>
            </div>
            <div class="row">
                @foreach( $posts as $post)
                    <div class="col-md-4">
                        <div class="post-grid__block">
                            <div class="post-wrap__image">
                                <img class=" post-grid__image" src="{{asset('storage/files/'.basename($post->image)) }}" alt="Card image cap">
                            </div>
                            <div class="post-grid__body">
                                <h3 class="post-grid__title"><a href="{{ url("/news/$post->id") }}">{{ $post->title }}</a></h3>
                                <p class="post-grid__text">{{ $post->excerpt }}</p>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
