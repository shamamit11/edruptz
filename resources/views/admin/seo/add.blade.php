@extends('admin.layout')
@section('content')
<div class="main-content d-flex flex-column"> @include('admin.includes.top-nav')
    <div class="breadcrumb-area">
        <h1>SEO</h1>
        <ol class="breadcrumb">
            <li class="item"><a href="{{ route('admin-seo')}}">SEO</a></li>
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
                    <label class="form-label"> Page Name</label>
                    <input type="text" class="form-control" name="name"
                        value="{{old('name' , isset($row->name)? $row->name : '' )}}">
                    @if($errors->has('name'))
                    <div class="error">{{$errors->first('name')}}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label"> Link</label>
                    <input type="text" class="form-control" name="link"
                        value="{{old('link' , isset($row->link)? $row->link : '' )}}">
                    @if($errors->has('link'))
                    <div class="error">{{$errors->first('link')}}</div>
                    @endif
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

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    @include('admin.includes.footer')
</div>
@endsection