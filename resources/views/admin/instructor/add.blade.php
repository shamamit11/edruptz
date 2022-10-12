@extends('admin.layout')
@section('content')
<div class="main-content d-flex flex-column"> @include('admin.includes.top-nav')
    <div class="breadcrumb-area">
        <h1>Instructors</h1>
        <ol class="breadcrumb">
            <li class="item"><a href="{{ route('admin-instructor')}}">Instructors</a></li>
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
                    <label class="form-label"> Commission</label>
                    <input type="text" class="form-control" name="commission"
                        value="{{old('commission' , isset($row->commission)? $row->commission : '' )}}">
                    @if($errors->has('commission'))
                    <div class="error">{{$errors->first('commission')}}</div>
                    @endif
                </div>

                <div class="mb-3 col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="1" @if (@$row->status == 1) selected @endif>Active</option>
                        <option value="0" @if (@$row->status == 0) selected @endif>Inactive</option>
                    </select>
                    @if ($errors->has('status'))
                        <div class="error">{{ $errors->first('status') }}</div>
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