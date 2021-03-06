@extends('frontend.layouts.main')
@section('title','About')
@section('content')
    <div class="banner banner3"
         style="background: url({{asset('/electronic_store/images/feature_laptop-home.jpg')}}) no-repeat center;background-size: cover;">
        <div class="decorated_img decorated_img2">
            <span>Who are we ?</span>
        </div>
    </div>

    <div class="breadcrumb_dress">
        <div class="container-fluid">
            <ul>
                <li><a href="{{url('/')}}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a> <i>/</i></li>
                <li>About</li>
            </ul>
        </div>
    </div>
    <!-- about -->
    <div class="about">
        <div class="container">
            <div class="w3ls_about_grids">
                <div class="col-md-6 w3ls_about_grid_left">
                    <p>Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                        cupidatat non proident, sunt in culpa qui officia deserunt mollit
                        anim id est laborum.</p>
                    <div class="col-xs-2 w3ls_about_grid_left1">
                        <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
                    </div>
                    <div class="col-xs-10 w3ls_about_grid_left2">
                        <p>Sunt in culpa qui officia deserunt mollit
                            anim id est laborum.Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur.</p>
                    </div>
                    <div class="clearfix"> </div>
                    <div class="col-xs-2 w3ls_about_grid_left1">
                        <span class="glyphicon glyphicon-flash" aria-hidden="true"></span>
                    </div>
                    <div class="col-xs-10 w3ls_about_grid_left2">
                        <p>Sunt in culpa qui officia deserunt mollit
                            anim id est laborum.Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur.</p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="col-md-6 w3ls_about_grid_right">
                    <img src="{{ asset('/electronic_store') }}/images/Our-attorna_img-1.jpeg" alt=" " class="img-responsive" />
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!-- //about -->
    <!-- team -->
    <div class="team">
        <div class="container">
            <h3>Meet Our Team</h3>
            <div class="wthree_team_grids">
                <div class="col-md-12 wthree_team_grid">
                    <img src="{{ asset('/electronic_store') }}/images/Our-attorna_img-3.jpeg" alt=" " class="img-responsive team_image" />
                    <h4>Ph????ng Ho??n <span>Developer</span></h4>
                    <div class="agileits_social_button">
                        <ul>
                            <li><a href="#" class="facebook"> </a></li>
                            <li><a href="#" class="twitter"> </a></li>
                            <li><a href="#" class="google"> </a></li>
                            <li><a href="#" class="pinterest"> </a></li>
                        </ul>
                    </div>
                </div>

                <div class="clearfix"> </div>
                <p>Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis
                    voluptatibus maiores alias consequatur aut perferendis doloribus asperiores
                    repellat.</p>
            </div>
        </div>
    </div>
    <!-- //team -->
    <!-- team-bottom -->
    <div class="team-bottom">
        <div class="container">
            <h3>Are You Ready For Deals? Flat <span>30% Offer </span>on Mobiles</h3>
            <p>Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis
                voluptatibus maiores alias consequatur aut perferendis doloribus asperiores
                repellat.</p>
            <a href="{{ route('cat.pro.all') }}">Shop Now</a>
        </div>
    </div>
    <!-- //team-bottom -->

@endsection
