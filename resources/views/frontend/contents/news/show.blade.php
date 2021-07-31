@extends('frontend.layouts.main')
@section('title','Blog')
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
                <li>Blog Post</li>
            </ul>
        </div>
    </div>


    <div class="post">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="post-main">
                    <div class="post__feature">
                        <img src="{{asset('storage/files/'. basename($post->image))}}" alt="" class="img-post-thumb">
                    </div>
                    <div class="post__title">
                        <h2>{{ $post->title }}</h2>
                    </div>
                    <div class="post__meta">
                        <p class="post__date">Posted on {{date('d/m/Y', strtotime($post->created_at ))}}</p>
                    </div>
                    <div class="post__content">
                        <p class="post__paragraph"> {{ $post->content_post }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="post-sidebar">
                    <div class="post__email">
                        <h2 class="post__message ">Want us to email you occasionally with Technology news?</h2>
                        <form class="post__form">
                            <input type="email" placeholder="Your email..." class="post__input">
                            <button type="submit">Subscribe</button>
                        </form>
                    </div>
                    <div class="post__recent">
                        <h3 class="recent__title">Recent Posts</h3>

                        <ul class="recent__list">
                            @foreach($recent_posts as $recent_post)
                                <li class="recent__item">
                                    <i class="fa fa-sticky-note-o  recent__icon"></i>
                                    <a class="recent__link" href="{{url("/news/$recent_post->id")}}">{{ $recent_post->title }}</a>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
