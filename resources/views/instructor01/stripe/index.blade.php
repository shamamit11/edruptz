@extends('instructor.layout')
@section('content')
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    @include('instructor.includes.header')
    <div class="app-main"> @include('instructor.includes.nav')
        <div class="app-main__outer">
            <div class="app-main__inner">
                <ol class="nobg breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('instructor-dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Connect with Stripe</li>
                </ol>
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div>Connect with Stripe
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-shadowNone mt-3">
                    <div class="row card-nopadding mt-1">
                        <div class="col-md-12">
                            @if($user->stripe_id)
                            <div class="main-card  card">
                                <div class="card-header">Strip Connected
                                </div>
                                <div class="p-3">
                                    <p class='mt-2'><strong>Account ID:</strong> {{ $user->stripe_id }}</p>
                                </div>
                            </div>
                            @else
                            <div class="main-card  card">
                                <div class="card-header">Stripe Connect
                                </div>
                                <div class="p-3">
                                    @include('instructor.includes.alert')
                                    <div class="col-md-4"> <a href='{{ $connectUri }}'
                                            class="btn btn-success btn-lg">Connect With Stripe</a></div>
                                </div>
                            </div>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
            @include('instructor.includes.footer')
        </div>
    </div>
</div>
@endsection