@extends('frontend.layouts.main')
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
                        User Information
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="user__image">
                        <img src="{{ asset('electronic_store') }}/images/resume.png" alt="" class="img-responsive">
                    </div>
                </div>
                <div class="col-md-8">
                    <form action="{{ route('profile.update') }}" method="POST" id="form_profile" autocomplete="off" >
                        @csrf
                        <div class="form-group">
                            <label for="name">Username</label>
                            <input type="text" class="form-control" id="profile_name" name="name" value="{{ $user->name }}">
                            <label id="error-profile-email"  class="error-input invisible-input"></label>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="profile_email" name="email" disabled value="{{ $user->email }}">
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="checkpass">
                            <label class="form-check-label" for="checkpass">Wanna change Password ?</label>
                        </div>
                        <div class="check_password">
                            <div class="form-group">
                                <label for="old_password">Old password</label>
                                <input type="password" class="form-control" id="old_password" name="oldpassword" placeholder="Enter  old password" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" class="form-control" id="profile_password" name="password" placeholder="Enter new password" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm password" autocomplete="off">
                                <label id="error-profile-repassword" class="error-input invisible-input "></label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>

        </div>
    </div>


@endsection
