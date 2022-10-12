@extends('instructor.layout')
@section('content')
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    @include('instructor.includes.header')
    <div class="app-main"> @include('instructor.includes.nav')
        <div class="app-main__outer">
            <div class="app-main__inner">
                <ol class="nobg breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('instructor-dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Connect with Strip</li>
                </ol>
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div>Connect with Strip
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-shadowNone mt-3">
                    <div class="row card-nopadding mt-1">
                        <div class="col-md-12">
                            <div class="main-card  card">
                                <div class="card-header">Strip Connected
                                </div>
                                <div class="p-3">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        Successfully connected with your Account!</div>
                                    <p class='mt-2'><strong>Account ID:</strong> {{ $account['id'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('instructor.includes.footer')
        </div>
    </div>
</div>
@endsection