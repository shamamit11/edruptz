@extends('student.layout')
@section('content')
<div class="main-content d-flex flex-column"> @include('student.includes.top-nav')
  <div class="breadcrumb-area">
    <h1>My Courses</h1>
    <ol class="breadcrumb">
      <li class="item"><a href="{{ route('student-dashboard')}}"><i class='bx bx-home-alt'></i></a></li>
      <li class="item"><a href="{{ route('student-course') }}">Courses</a></li>
      <li class="item">{{$row->name}}</li>
    </ol>
  </div>
  <div class="card mb-10">
    <div class="card-body">
    <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
              <div class="card">
                <div> @if($row->image) <img src="{{ asset('storage/uploads/course/'.$row->image) }}"
                                        style="width:100%;" /> @else <img
                                        src="{{ asset('assets/images/no-course-image') }}" style="width:100%;"> @endif </div>
                <div class="card-body">
                  <div>{!!$row->description!!} </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12"> @include('student.includes.alert')
              @if(count($row->lessons) > 0)
               @php 
              $cnt = 1;
              @endphp
              <div class="card mb-4">
                <div class="card-header"><h3> Lessons </h3></div>
                <div class="card-body"> @foreach($row->lessons as $lesson)
                  <div class="mb-2">{{ $cnt }}. <a href="{{ route('student-lesson', [$row->slug, Crypt::encryptString($lesson->id)]) }}" class="btn btn-sm rounded-pill">{{ $lesson->name }}</a> <span class="pull-right alert-info px-2"> @if($lesson->status == 1)Read @else Unread @endif</span></div>
                   @php $cnt++ @endphp
                  @endforeach </div>  
              </div>
              @endif
              <div class="card mb-4">
                <div class="card-body">
                  <div class="d-flex">
                    <div class="profile-pic"> @if($row->instructor->image) <img
                                                src="{{asset('/storage/uploads/instructor/'.$row->instructor->image)}}"
                                                width="60px" height="60px" /> @else <img
                                                src="{{asset('assets/images/no-image.jpg')}}" width="60px"
                                                height="60px"> @endif </div>
                    <div class="d-flex flex-column px-3 ">
                      <h4 class="m-0"> {{ $row->instructor->name}}</h4>
                      <p class="grey-text"> {{ $row->instructor->professional }}</p>
                      <div class="rating"> 
			@if($avg_rating > 0)
			@for($i = 1; $i<=$avg_rating; $i++)
              <i class="fa fa-star text-warning"></i>
            
              @endfor @if($avg_rating < 5) @for($i = ($avg_rating+1) ; $i<=5; $i++)  
              <i class="fa fa-star"></i>
              @endfor @endif
              @else
              <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i>
             @endif <small class="pull-right  alert-info px-2"> {{ count($row->instructor->reviews) }} reviewed </small> </div>
                    </div>
                  </div>
                  <div>{!! $row->instructor->about_me !!}</div>
                </div>
              </div>
              <div class="card mb-4">
                <div class="card-header"><h3> Instructor Ratings</h3> </div>
                <div class="card-body">
                  <form method="post" action="{{ route('student-instructor-reviews', Crypt::encryptString($row->id))}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="instructor_id" value="{{ $row->instructor->id}}">
                    <div class="form-group">
                       <label class="form-label">Rate:</label>
                      <fieldset class="star-rating">
                        <input name="rating" type="radio" id="rating5" value="5" />
                        <label for="rating5" title="5 stars">☆</label>
                        <input name="rating" type="radio" id="rating4" value="4"/>
                        <label for="rating4" title="4 stars">☆</label>
                        <input name="rating" type="radio" id="rating3" value="3" checked />
                        <label for="rating3" title="3 stars">☆</label>
                        <input name="rating" type="radio" id="rating2" value="2"  />
                        <label for="rating2" title="2 stars">☆</label>
                        <input name="rating" type="radio" id="rating1" value="1" />
                        <label for="rating1" title="1 stars">☆</label>
                      </fieldset>
                    </div>
                    <div class="form-group">
                       <label class="form-label"> Review:</label>
                      <textarea name="description" class="form-control required" style="height:100px;">
</textarea>
                    </div>
                    <div class="form-group">
                       <label class="form-label"></label>
                      <button type="submit" class="btn btn-success btn-block">Review Now</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
    </div>
  </div>
  @include('student.includes.footer') </div>
@endsection
@section('footer-scripts')

@endsection