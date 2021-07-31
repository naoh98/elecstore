<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield("title")</title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- end for-mobile-apps -->

    <link href="{{asset('/electronic_store')}}/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="{{asset('/electronic_store')}}/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="{{asset('/electronic_store')}}/css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
    <link href="{{asset('/electronic_store')}}/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/electronic_store')}}/css/jquery.countdown.css" />
    <link rel="stylesheet" href="{{asset('/electronic_store')}}/css/fasthover.css" />
    <link rel="stylesheet" href="{{asset('/electronic_store')}}/css/main.css" /> <!-- custom css tại đây -->

    <script src="{{asset('/electronic_store')}}/js/jquery.min.js"></script>
    <script type="text/javascript" src="{{asset('/electronic_store')}}/js/bootstrap-3.1.1.min.js"></script>
    <script src="{{asset('/electronic_store')}}/js/jquery.wmuSlider.js"></script>
    <script src="{{asset('/electronic_store')}}/js/jquery.countdown.js"></script>
    <script src="{{asset('/electronic_store')}}/js/script.js"></script>
    <script src="{{asset('/electronic_store')}}/js/jquery.magnific-popup.js" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('/electronic_store')}}/js/jquery.flexisel.js"></script>
    <script src="{{asset('/electronic_store')}}/js/easyResponsiveTabs.js" type="text/javascript"></script>

    <link rel="icon" href="{{ URL::asset('/favicon.ico') }}" type="image/x-icon"/>
</head>
<body>

@include('frontend.partials.header')

@include('frontend.partials.nav')

    <div class="page-wrapper">
        @yield('content')
    </div>


@include('frontend.partials.newsletter')

@include('frontend.partials.footer')

{{--@include('frontend.partials.minicart')--}}

<script src="{{asset('/electronic_store')}}/js/main.js" type="text/javascript"></script> <!-- custom js tại đây -->
 @yield('scripts')
</body>
</html>
