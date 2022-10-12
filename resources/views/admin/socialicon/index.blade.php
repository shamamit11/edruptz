@extends('admin.layout')
@section('content')
<div class="main-content d-flex flex-column"> @include('admin.includes.top-nav')
    <div class="breadcrumb-area">
        <h1>Social Links</h1>
        <ol class="breadcrumb">
            <li class="item">Social Links</li>
        </ol>
    </div>
    <div class="card mb-10">
        @include('admin.includes.alert')
        <div class="card-body">
            <form enctype="multipart/form-data" method="post" action="{{$action}}" id="form">
                @csrf
                <div class="mb-3">
                    <label class="form-label"> Facebook</label>
                    <input type="text" class="form-control" name="facebook"
                        value="{{old('facebook' , isset($row->facebook)? $row->facebook : '' )}}">
                </div>
                <div class="mb-3">
                    <label class="form-label"> Twitter</label>
                    <input type="text" class="form-control" name="twitter"
                        value="{{old('twitter' , isset($row->twitter)? $row->twitter : '' )}}">
                </div>
                <div class="mb-3 hide">
                    <label class="form-label"> Linkedin</label>
                    <input type="text" class="form-control" name="linkedin"
                        value="{{old('linkedin' , isset($row->linkedin)? $row->linkedin : '' )}}">
                </div>
                <div class="mb-3">
                    <label class="form-label"> Instagram</label>
                    <input type="text" class="form-control" name="instagram"
                        value="{{old('instagram' , isset($row->instagram)? $row->instagram : '' )}}">
                </div>
                <div class="mb-3 hide">
                    <label class="form-label"> Youtube</label>
                    <input type="text" class="form-control" name="youtube"
                        value="{{old('youtube' , isset($row->youtube)? $row->youtube : '' )}}">
                </div>
                <div class="mb-3 hide">
                    <label class="form-label"> Whatsapp</label>
                    <input type="text" class="form-control" name="whatsapp"
                        value="{{old('whatsapp' , isset($row->whatsapp)? $row->whatsapp : '' )}}">
                </div>
                <div class="mb-3 hide">
                    <label class="form-label"> Pinterest</label>
                    <input type="text" class="form-control" name="pinterest"
                        value="{{old('pinterest' , isset($row->pinterest)? $row->pinterest : '' )}}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    @include('admin.includes.footer')
</div>
@endsection