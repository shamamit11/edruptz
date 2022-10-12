@extends('admin.layout')
@section('content')
<div class="main-content d-flex flex-column"> @include('admin.includes.top-nav')
    <div class="breadcrumb-area">
        <h1>Commission</h1>
        <ol class="breadcrumb">
            <li class="item"><a href="{{ route('admin-commission')}}">Commission</a></li>
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

                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <label class="form-label">Commission(%)</label>
                            <input type="text" class="form-control" name="commission"
                                value="{{old('commission' , isset($row->commission) ? $row->commission : '')}}">
                            @if($errors->has('commission'))
                            <div class="error">{{$errors->first('commission')}}</div>
                            @endif
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <label class="form-label">Default</label>
                            <label class="switch">
                                <input type="checkbox" class="switch-input" name="default" value="1" {{ ((isset($row->
                default) && $row->default == 1) ||  !isset($row->default))? 'checked' : '' }} /> <span
                                    class="switch-label" data-on="Yes" data-off="No"></span> <span
                                    class="switch-handle"></span> </label>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <label class="form-label">Status</label>
                            <label class="switch">
                                <input type="checkbox" class="switch-input" name="status" value="1" {{ ((isset($row->
                status) && $row->status == 1) ||  !isset($row->status))? 'checked' : '' }} /> <span
                                    class="switch-label" data-on="Show" data-off="Hide"></span> <span
                                    class="switch-handle"></span> </label>
                        </div>
                    </div>
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