@extends('instructor.layout')
@section('content')
    <div class="main-content d-flex flex-column">
        @include('instructor.includes.top-nav')
        <div class="breadcrumb-area">
            <h1>Stripe Connect</h1>
            <ol class="breadcrumb">
                <li class="item"><a href="{{ route('instructor-dashboard') }}"><i class='bx bx-home-alt'></i></a></li>
                <li class="item">Stripe Connect</li>
            </ol>
        </div>

        @if($user->stripe_id)
            <div class="card mb-10">
                <div class="card-body">
                    <div class="mb-3"><strong>Connect Status:</strong> Connected</div>
                    <div class=""><strong>Account ID:</strong> {{ $user->stripe_id }}</div>
                </div>
            </div>
        @else
            <div class="card mb-10">
                <div class="card-body">
                    @include('instructor.includes.alert')
                    <div class="">
                        <a href='{{ $connectUri }}' class="btn btn-success">Connect With Stripe</a>
                    </div>
                </div>
            </div>
        @endif
        @include('instructor.includes.footer')
    </div>
@endsection