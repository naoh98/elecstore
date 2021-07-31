@extends('backend.layouts.main')
@section('title','Profile')
@section('content')
    <div class="profile">
        <div class="container pt-4">
            <div class="row">
                @if(session('status'))
                    <div class="alert alert-success">
                        {{session('status')}}
                    </div>
                @endif
                <div class="col-md-12">
                    <h3 class="profile__heading">
                        Admin Information
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="user__image">
                        <img src="{{ asset('sbadmin2') }}/img/profile-detail.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="col-md-8">
                    <form action="{{ route('admin.profile.update') }}" method="POST" id="form_profile" autocomplete="off" >
                        @csrf
                        <div class="form-group">
                            <label for="name">Username</label>
                            <input type="text" class="form-control" id="profile_name" name="name" value="{{ $admin->name }}">
                            <label id="error-profile-email"  class="error-input invisible-input"></label>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="profile_email" name="email" value="{{ $admin->email }}">
                        </div>
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" class="form-control" id="profile_password" name="password" placeholder="Enter new password" autocomplete="off">
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>

        </div>
    </div>


@endsection
