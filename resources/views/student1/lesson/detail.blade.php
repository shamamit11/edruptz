@extends('student.layout')
@section('content')
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header"> @include('student.includes.header')
  <div class="app-main"> @include('student.includes.nav')
    <div class="app-main__outer">
      <div class="app-main__inner">
        <ol class="nobg breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('student-dashboard')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{route('student-course')}}">Course</a></li>
          <li class="breadcrumb-item"><a
                            href="{{ route('student-course-detail', Crypt::encryptString($row->course->id))}}">{{$row->course->name}}</a> </li>
          <li class="breadcrumb-item active">{{$row->name}}</li>
        </ol>
        <div class="app-page-title">
          <div class="page-title-wrapper">
            <div class="page-title-heading">
              <div>{{$row->name}} </div>
            </div>
          </div>
        </div>
        <div class="card-shadowNone mt-3">
          <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
              <div class="card">
                <div class="card-body">{!! $row->description !!}
                  @if($row->video)
                  <video controls class="mb-4">
                    <source src="{{ asset('storage/uploads/lesson/'.$row->video)}}"
                                            type="video/mp4">
                    Your browser does not support HTML5 video. </video>
                  @endif
                  <div class="row"> @if($row->file)
                    <div class="col-lg-6 col-md-6 col-sm-6"> <a href="{{ asset('storage/uploads/lesson/'.$row->file)}}"
                                                class="btn btn-primary btn-block flex-column" target="_blank"> <i
                                                    class="fa fa-download d-block"></i> Download Files </a> </div>
                    @endif
                    
                    @if($row->assessment)
                    <div class="col-lg-6 col-md-6 col-sm-6"><a
                                                href="{{ asset('storage/uploads/lesson/'.$row->assessment)}}"
                                                class="btn btn-success btn-block flex-column" target="_blank"> <i
                                                    class="fa fa-download d-block"></i> Download Assessment </a></div>
                    @endif </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12"> @include('student.includes.alert')
              @if(count($row->course->lessons) > 0)
              @php
              $reading_percent = 0;
              $cnt = 1;
              @endphp
              <div class="card mb-4">
                <div class="card-header"> Lessons </div>
                <div class="card-body"> @foreach($row->course->lessons as $lesson)
                  @if($lesson->status == 1)
                  @php $reading_percent = $reading_percent + round((100/count($row->course->lessons)),
                  2); @endphp
                  @endif
                  <div class="mb-2">{{ $cnt }}. <a
                                            href="{{ route('student-lesson', [$row->course->slug, Crypt::encryptString($lesson->id)]) }}">{{ $lesson->name }}</a> <span class="pull-right alert-info px-2"> @if($lesson->status == 1)Read @else
                    Unread @endif</span> </div>
                  @php $cnt++ @endphp
                  @endforeach
                  <div class="rating"> @if($avg_rating > 0)
                    @for($i = 1; $i<=$avg_rating; $i++) <i class="fa fa-star text-warning"></i> @endfor @if($avg_rating < 5) @for($i=($avg_rating+1) ; $i<=5; $i++) <i
                                                class="fa fa-star-o text-warning"></i> @endfor @endif
                    @else <i class="fa fa-star-o text-warning"></i> <i
                                                    class="fa fa-star-o text-warning"></i> <i
                                                    class="fa fa-star-o text-warning"></i> <i
                                                    class="fa fa-star-o text-warning"></i> <i
                                                    class="fa fa-star-o text-warning"></i> @endif <small class="pull-right  alert-info px-2"> {{ count($row->course->reviews) }} reviewed </small> </div>
                </div>
              </div>
              @endif
              @if($row->assessment)
              <div class="card mb-4">
                <div class="card-header">Assessment of  {{$row->name}}</div>
                <div class="card-body">
                  <form method="post"
                                    action="{{ route('student-lesson-assessment', [$row->course->slug, Crypt::encryptString($lesson->id)]) }}"
                                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="lesson_id" value="{{ $row->id}}">
                    <input type="hidden" name="instructor_id" value="{{ $row->course->instructor_id}}">
                    <div class="form-group">
                      <input name="assessment" type="file" />
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-success btn-block">Submit Assessment</button>
                    </div>
                  </form>
                </div>
              </div>
              @endif
              <div class="card mb-4">
                <div class="card-header"> Course Ratings </div>
                <div class="card-body"> @if($reading_percent < 25)
                  <div class="alert alert-info mt-2" role="alert">Please
                    read at least 25% of course to review. </div>
                  @else
                  <form method="post"
                                    action="{{ route('student-course-reviews', [$row->course->slug, Crypt::encryptString($lesson->id)]) }}"
                                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $row->course->id}}">
                    <div class="form-group">
                      <label>Rate:</label>
                      <fieldset class="star-rating">
                        <input name="rating" type="radio" id="rating5" value="5" />
                        <label for="rating5" title="5 stars">☆</label>
                        <input name="rating" type="radio" id="rating4" value="4" />
                        <label for="rating4" title="4 stars">☆</label>
                        <input name="rating" type="radio" id="rating3" value="3" checked />
                        <label for="rating3" title="3 stars">☆</label>
                        <input name="rating" type="radio" id="rating2" value="2" />
                        <label for="rating2" title="2 stars">☆</label>
                        <input name="rating" type="radio" id="rating1" value="1" />
                        <label for="rating1" title="1 stars">☆</label>
                      </fieldset>
                    </div>
                    <div class="form-group">
                      <label> Review:</label>
                      <textarea name="description" class="form-control required"
                                            style="height:100px;">
</textarea>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-success btn-block">Review Now</button>
                    </div>
                  </form>
                  @endif </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @include('student.includes.footer') </div>
  </div>
</div>
@endsection

@section('footer-scripts')

@endsection