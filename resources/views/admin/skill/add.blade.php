@extends('admin.layout')
@section('content')
<div class="main-content d-flex flex-column"> @include('admin.includes.top-nav')
    <div class="breadcrumb-area">
        <h1>Blog Images</h1>
        <ol class="breadcrumb">
            <li class="item"><a href="{{ route('admin-blog')}}">Blog Images</a></li>
            <li class="item">{{ $title }}</li>
        </ol>
    </div>
    <div class="card mb-10">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>{{ $title }}</h3>
        </div>
        <div class="card-body">
            <form enctype="multipart/form-data" method="post" action="{{$action}}" id="form">
                @csrf
                <input type="hidden" class="form-control" name="id" value="{{ isset($row->id)? $row->id : '' }}">
                <div class="mb-3">
                    <label class="form-label"> Name</label>
                    <input type="text" class="form-control" name="name"
                        value="{{old('name' , isset($row->name)? $row->name : '' )}}">
                    @if($errors->has('name'))
                    <div class="error">{{$errors->first('name')}}</div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    @include('admin.includes.footer')
</div>
@endsection
@section('footer-scripts')
@endsection