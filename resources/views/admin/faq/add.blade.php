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
                    <label class="form-label"> Question</label>
                    <input type="text" class="form-control" name="question"
                        value="{{old('question' , isset($row->question)? $row->question : '' )}}">
                    @if($errors->has('question'))
                    <div class="error">{{$errors->first('question')}}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">Answer</label>
                    <textarea class="form-control answer"
                        name="answer">{{old('answer' , isset($row->answer)? $row->answer : '' )}}</textarea>
                    @if($errors->has('answer'))
                    <div class="error">{{$errors->first('answer')}}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <label class="form-label"> Types</label>
                            <select name="types" class="form-control">
                                <option value="instructor" @if(@$row->types == 'instructor') selected @endif>Instructor</option>
                                <option value="student" @if(@$row->types == 'student') selected @endif>Student</option>
                            </select>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <label class="form-label">Order By</label>
                            <input type="text" class="form-control required digits" name="orders"
                                value="{{old('orders' , isset($row->orders) ? $row->orders : $orders)}}">
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
<script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>
<script>
$().ready(function() {
    ClassicEditor.create(document.querySelector('.answer'), {
        removePlugins: ['CKFinder', 'EasyImage', 'Image', 'ImageUpload', 'MediaEmbed']
    });
});
</script>
@endsection