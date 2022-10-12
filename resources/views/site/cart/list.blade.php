@extends('site.layout')
@section('content')
@php
use Illuminate\Support\Facades\Auth;
@endphp
<main class="main" style="background-color:#fff;">
  <section class="accountBanner innerBanner">
    <div class="ibPic"><img src="{{ asset('assets/images/courses-banner.jpg') }}" alt=""></div>
    <div class="overlay"></div>
    <div class="ibCont text-center txtwhite">
      <h1>My Cart</h1>
    </div>
  </section>
  <section class="mt-5 mb-5">
    <div class="container">
      <div class="accountSetting courseDetails">
        <div class="row"> @php $sub_total = 0; @endphp
          @if($carts->count() > 0)
          <div class="col-md-9">
            <div class="ibox">
              <div class="ibox-title">
                <h5>Items in your cart</h5>
              </div>
              @foreach($carts as $cart)
              @php 
              $amount = $cart->amount;
              $sub_total = $sub_total + $amount; 
              @endphp
              <div class="ibox-content">
                <div class="table-responsive">
                  <table class="table shoping-cart-table">
                    <tbody>
                      <tr>
                        <td class="desc"><h3> <a href="{{ $cart->course->slug}}" class="text-navy">{{ $cart->course->name}} </a> </h3>
                          <div class="m-t-sm mt-3"> <a href="{{ route('cart-delete', [$cart->id])}}" class="text-muted"><i class="fa fa-trash"></i> Remove item</a> </div></td>
                        <td><h4>USD{{ $cart->amount}} </h4></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              @endforeach
              <div class="ibox-content"> @if( Auth::guard('student')->user())
                <button class="btn btn-green pull-right" onClick="window.location='{{ route('cart-stripe') }}'"><i class="fa fa fa-shopping-cart"></i> Checkout</button>
                @else
                <button class="btn btn-green pull-right" onClick="window.location='{{ route('login') }}'"><i class="fa fa fa-shopping-cart"></i> Checkout</button>
                @endif
                <button class="btn btn-white" onClick="window.location='{{ route('courses') }}'"><i class="fa fa-arrow-left"></i> Continue shopping</button>
              </div>
            </div>
          </div>
          <div class="col-md-3"> 
            <div class="ibox">
              <div class="ibox-title">
                <h5>Cart Summary</h5>
              </div>
              <div class="ibox-content"> <span> Total </span>
                <h2 class="font-bold"> USD {{$sub_total}} </h2>
                <hr>
                <div class="m-t-sm">
                  <div class="btn-group"> @if( Auth::guard('student')->user()) <a href="{{ route('cart-stripe') }}" class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart"></i> Checkout</a> @else <a href="{{ route('login') }}" class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart"></i> Checkout</a> @endif </div>
                </div>
              </div>
            </div>
            </div>
                @else
        <div class="col-md-12">
          <div class="ibox-content-alert"> No cart</div>
        </div>
        @endif
        </div>
     </div>
    </div>
  </section>
</main>
@endsection
@section('footer-scripts')

@endsection 