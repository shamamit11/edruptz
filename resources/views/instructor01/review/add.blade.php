@extends('instructor.layout')
@section('content')
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header"> @include('instructor.includes.header')
  <div class="app-main"> @include('instructor.includes.nav')
    <div class="app-main__outer">
      <div class="app-main__inner">
        <ol class="nobg breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('instructor-dashboard')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{route('instructor-course')}}">Courses</a></li>
          <li class="breadcrumb-item active">Lesson</li>
        </ol>
       
        <div class="card-shadowNone">
          <div class="row">
            <div class="col-md-8">
              <div class="card mt-4">
                <div class="card-header"><i class="fa fa-align-left icon-gradient bg-love-kiss mr-2" aria-hidden="true"></i> {{ $title }}</div>
                <div class="card-body">
                  <form action="{{ $action }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" class="form-control" name="id" value="{{ isset($row->id)? $row->id : '' }}">
                 
                    <div class="form-group">
                      <label class="form-label">Student Review</label>
                    <div>{!! nl2br($row->description) !!}</div>
                    </div>
                    <div class="form-group">
                      <label class="form-label">Reply</label>
                      <textarea class="form-control description" name="description">{{old('description' , isset($row->reply->description)? $row->reply->description : '' )}}</textarea>
                      @if($errors->has('description'))
                      <div class="error">{{$errors->first('description')}}</div>
                      @endif </div>
                    <div class="form-group">
                  
                    <div class="form-group">
                      <button type="submit" class="btn-shadow btn btn-success"> <span class="btn-icon-wrapper pr-2 opacity-7"> </span> Reply </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @include('instructor.includes.footer') </div>
  </div>
</div>
@endsection 
@section('footer-scripts') 
@endsection