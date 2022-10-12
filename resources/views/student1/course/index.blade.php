@extends('student.layout')
@section('content')
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header"> @include('student.includes.header')
  <div class="app-main"> @include('student.includes.nav')
    <div class="app-main__outer">
      <div class="app-main__inner">
        <ol class="nobg breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('student-dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Courses</li>
        </ol>
        <div class="app-page-title">
          <div class="page-title-wrapper">
            <div class="page-title-heading">
              <div>All Courses
              </div>
            </div>
          </div>
        </div>
        <div class="card-shadowNone mt-3">
        @if($courses->count() > 0)
          <div class="row">
   			   @foreach($courses as $course)
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card  mb-4">
                <div class="card-header"><a href="{{ route('student-course-detail', Crypt::encryptString($course->course->id))}}">{{ $course->course->name}}</a></div>
                <a href="{{ route('student-course-detail', Crypt::encryptString($course->course->id))}}">  @if($course->course->image) <img src="{{ asset('storage/uploads/course/'.$course->course->image) }}"   style="width:100%;" /> @else <img src="{{ asset('assets/images/no-course-image') }}"  style="width:100%;"> @endif  </a>
                <div class="card-body">
                  <div class="rating"> <i class="fa fa-star text-warning my-auto"></i> <i class="fa fa-star text-warning my-auto"></i> <i class="fa fa-star text-warning my-auto"></i> <i class="fa fa-star text-warning my-auto"></i> <i class="fa fa-star text-warning my-auto"></i> </div>
                  <p class="card-text">{{ $course->course->summary }}</p></div>
                <div class="card-footer c-card-footer">
                  <div class="text-muted"><i class="fa fa-leanpub" aria-hidden="true"></i> {{ count($course->course->lessons) }} Lessons</div>
                  <div class="pull-right"><a href="{{ route('student-course-detail', Crypt::encryptString($course->course->id))}}">View Details</a></div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          @endif
        </div>
      </div>
        @include('student.includes.footer')
    </div>
  </div>
</div>
@endsection

@section('footer-scripts') 

@endsection