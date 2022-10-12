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

        <div class="card mb-10">
            <div class="card-body">
                <div class="">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">Successfully connected with your Account!</div>
                    <div class=""><strong>Account ID:</strong> {{ $account['id'] }}</div>
                </div>
            </div>
        </div>

        @include('instructor.includes.footer')
    </div>

@endsection