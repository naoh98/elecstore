@extends('frontend.layouts.main')
@section('title','Cart')
@section('content')
   <div class="confirm-order">
       <h3>Thanks for your order ! </h3>
       <div class="confirm-order__image">
          <i class="fa fa-check"></i>
       </div>
       <a href="{{ route('cat.pro.all') }}" class="btn btn-primary">Continue shopping ?</a>
   </div>
@endsection
