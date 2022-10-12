@extends('site.layout')
@section('content')
<main class="main" style="background-color:#fff;">
    <section class="accountBanner innerBanner">
        <div class="ibPic"><img src="{{ asset('assets/images/courses-banner.jpg') }}" alt=""></div>
        <div class="overlay"></div>
        <div class="ibCont text-center txtwhite">
            <h1>Payment Success</h1>
        </div>
    </section>
    <section class="mt-5 mb-5">
        <div class="container">
            <div class="accountSetting courseDetails">
                <div class="row">
                    <div class="col-md-10">
                   Your payment has beeen success. 
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
@section('footer-scripts')

@endsection