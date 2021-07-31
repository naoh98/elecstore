@extends('frontend.layouts.main')
@section('title', 'Contact')
@section('content')

<!-- banner -->
<div class="banner banner3"
            style="background: url({{asset('/electronic_store/images/mb-mockup.jpg')}}) no-repeat center;background-size: cover;">
    <div class="decorated_img decorated_img1">
        <span>Write us something !</span>
    </div>
</div>
<!-- //banner -->
<!-- breadcrumbs -->
<div class="breadcrumb_dress">
    <div class="container-fluid">
        <ul>
            <li><a href="{{url('/')}}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a> <i>/</i></li>
            <li>Contact Us</li>
        </ul>
    </div>
</div>
<!-- //breadcrumbs -->
<!-- mail -->
<div class="mail">
    <div class="container">
        <h3>Mail Us</h3>
        <div class="agile_mail_grids">
            <div class="col-md-5 contact-left">
                <h4>Address</h4>
                <p>Hân hạnh phục vụ quý khách tại <br>
                    <span>96 Dinh Cong,Thanh Xuan, Ha Noi</span></p>
                <ul>
                    <li>Free Phone :+1 078 4589 2456</li>
                    <li>Telephone :+1 078 4589 2456</li>
                    <li>Fax :+1 078 4589 2456</li>
                    <li><a href="mailto:info@example.com">QuangAnh@gmail.com</a></li>
                    <li><a href="mailto:info@example.com">HoanNguyen@gmail.com</a></li>
                </ul>
            </div>
            <div class="col-md-7 contact-left">
                <h4>Contact Form</h4>
                <form action="#" method="post">
                    <input type="text" name="Name" placeholder="Your Name" required="">
                    <input type="email" name="Email" placeholder="Your Email" required="">
                    <input type="text" name="Telephone" placeholder="Telephone No" required="">
                    <textarea name="message" placeholder="Message..." required=""></textarea>
                    <input type="submit" value="Submit" >
                </form>
            </div>
            <div class="clearfix"> </div>
        </div>

        <div class="contact-bottom">
            <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d96908.54934770924!2d-73.74913540000001!3d40.62123259999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sanimal+rescue+service+near+Inwood%2C+New+York%2C+NY%2C+United+States!5e0!3m2!1sen!2sin!4v1436335928062" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </div>
</div>
<!-- //mail -->
@endsection
