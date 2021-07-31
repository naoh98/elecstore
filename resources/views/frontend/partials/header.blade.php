<!-- log/reg tab -->
@include('frontend.partials.modal')
<!-- end log/reg tab -->

<!-- header -->
<div class="header" id="home1">
    <div class="container">
        <div class="header-wrapper">
            <div class="w3l_login">
                @guest
                    <a href="#" data-toggle="modal" data-target="#myModal88" class="w3_login_icon">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    </a>
                @endguest
                @auth
                    <a href="#" class="w3l_login__btn">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>

                        <span class="w3l_login__username"> Hello {{\Illuminate\Support\Facades\Auth::user()->name }}</span>

                    </a>

                    <div id="myDropdown" class="dropdown-content">
                        <a href="{{ route('profile.index') }}" class="user__link"><i class="fa fa-tablet"></i>Profile</a>
                        <a href="{{ route('showCart') }}" class="user__link"><i class="fa fa-shopping-bag"></i>Your cart</a>
                        <a href="{{ route('logout') }}" class="user__link" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                            <i class="fa fa-sign-out"></i>Logout
                        </a>
                        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                @endauth
            </div>
            <div class="w3l_logo">
                <h1><a href="{{route('homepage')}}">Electronic Store<span>Your stores. Your place.</span></a></h1>
            </div>
            <div class="box_1">

                <a href="{{ route('showCart') }}" class="w3view-cart">
                        <i class="fa fa-shopping-cart " aria-hidden="true"></i>
                        <span class="cart__number">{{ session('cart') != null? count((array) session('cart')):0 }}</span>

                </a>
            </div>
        </div>

    </div>
</div>
<!-- end header -->

@section('scripts')
    @parent
    @if($errors->has('email') || $errors->has('password'))
        <script>
            $(function() {
                $('#myModal88').modal({
                    show: true
                });
            });
        </script>
    @endif
@endsection
