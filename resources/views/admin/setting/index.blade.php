@extends('admin.layout')
@section('content')
<div class="main-content d-flex flex-column"> @include('admin.includes.top-nav')
    <div class="breadcrumb-area">
        <h1>General Settings</h1>
        <ol class="breadcrumb">
            <li class="item">General Settings</li>
        </ol>
    </div>
    <div class="card mb-10">
        @include('admin.includes.alert')
        <div class="card-body">
            <form enctype="multipart/form-data" method="post" action="{{$action}}" id="form">
                @csrf
                <div class="mb-3">
                    <label class="form-label"> Site Name</label>
                    <input type="text" class="form-control" name="site_name"
                        value="{{old('site_name' , isset($row->site_name)? $row->site_name : '' )}}">
                    @if($errors->has('site_name'))
                    <div class="error">{{$errors->first('site_name')}}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label"> General Email</label>
                    <input type="text" class="form-control" name="email"
                        value="{{old('email' , isset($row->email)? $row->email : '' )}}">
                    @if($errors->has('email'))
                    <div class="error">{{$errors->first('email')}}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label"> Support Email</label>
                    <input type="text" class="form-control" name="support_email"
                        value="{{old('support_email' , isset($row->support_email)? $row->support_email : '' )}}">
                    @if($errors->has('support_email'))
                    <div class="error">{{$errors->first('support_email')}}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label"> Student Email</label>
                    <input type="text" class="form-control" name="student_email"
                        value="{{old('student_email' , isset($row->student_email)? $row->student_email : '' )}}">
                    @if($errors->has('email'))
                    <div class="error">{{$errors->first('student_email')}}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label"> Instructor Email</label>
                    <input type="text" class="form-control" name="instructor_email"
                        value="{{old('instructor_email' , isset($row->instructor_email)? $row->instructor_email : '' )}}">
                    @if($errors->has('email'))
                    <div class="error">{{$errors->first('email')}}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label"> Phone</label>
                    <input type="text" class="form-control" name="phone"
                        value="{{old('phone' , isset($row->phone)? $row->phone : '' )}}">
                    @if($errors->has('phone'))
                    <div class="error">{{$errors->first('phone')}}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label"> Address</label>
                    <textarea class="form-control"
                        name="address">{{old('address' , isset($row->address)? $row->address : '' )}}</textarea>
                    @if($errors->has('address'))
                    <div class="error">{{$errors->first('address')}}</div>
                    @endif
                </div>
                <div class="mb-3 hide">
                    <label class="form-label"> Years</label>
                    <input type="text" class="form-control" name="years"
                        value="{{old('years' , isset($row->years)? $row->years : '' )}}">
                </div>
                <div class="mb-3">
                    <label class="form-label"> Meta Title</label>
                    <input type="text" class="form-control" name="meta_title"
                        value="{{old('meta_title' , isset($row->meta_title)? $row->meta_title : '' )}}">
                    @if($errors->has('meta_title'))
                    <div class="error">{{$errors->first('meta_title')}}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label"> Meta Description</label>
                    <textarea class="form-control"
                        name="meta_description">{{old('meta_description' , isset($row->meta_description)? $row->meta_description : '' )}}</textarea>
                    @if($errors->has('meta_description'))
                    <div class="error">{{$errors->first('meta_description')}}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label"> Google Site Verification</label>
                    <input type="text" class="form-control" name="google_site_verification"
                        value="{{old('google_site_verification' , isset($row->google_site_verification)? $row->google_site_verification : '' )}}">
                </div>
                <div class="mb-3">
                    <label class="form-label"> Google Analytics</label>
                    <textarea class="form-control" name="google_analytics"
                        rows="10">{{old('google_analytics' , isset($row->google_analytics)? $row->google_analytics : '' )}}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Map</label>
                    <textarea class="form-control" name="map"
                        rows="7">{{old('map' , isset($row->map)? $row->map : '' )}}</textarea>
                    @if($errors->has('map'))
                    <div class="error">{{$errors->first('map')}}</div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    @include('admin.includes.footer')
</div>
@endsection