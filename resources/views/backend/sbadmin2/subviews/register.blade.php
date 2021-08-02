@extends('backend.sbadmin2.layouts.register')

@section('title', 'Sb-admin2 - Register')

@section('content')
<div class="card o-hidden border-0 shadow-lg my-5">

    @if (session('status'))
        <div class="alert alert-danger text-center">
            {{ session('status') }}
        </div>
    @endif

    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-5 d-lg-block" style="background: url({{ asset('/sbadmin2/img/register-admin.png') }}) no-repeat center;background-size: cover"></div>
            <div class="col-lg-7">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                    </div>
                    <form action="{{url('admin/register')}}" method="post" name="sblogin" class="user">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <input type="text" name="username" class="form-control form-control-user" id="exampleFirstName" placeholder="User Name">

                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address">
                        </div>
                        <div class="form-group row">

                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                            </div>

                            {{--<div class="col-sm-6">--}}
                                {{--<input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password">--}}
                            {{--</div>--}}
                        </div>
                       <input type="submit" name="submit" value="Register Account" class="btn btn-primary btn-user btn-block">

                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="{{url('/admin/login')}}">Already have an account? Login!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
