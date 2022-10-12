@php use App\Models\Course @endphp 
@extends('student.layout')
@section('content')
<div class="main-content d-flex flex-column"> @include('student.includes.top-nav')
  <div class="breadcrumb-area">
    <h1>My Courses</h1>
    <ol class="breadcrumb">
      <li class="item"><a href="{{ route('student-dashboard')}}"><i class='bx bx-home-alt'></i></a></li>
      <li class="item">Courses</li>
    </ol>
  </div>
  <div class="card mb-10">
    <div class="card-body"> @include('student.includes.alert')
      @if($courses->count() > 0)
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col" width="50">#</th>
            <th scope="col">Course Name</th>
            <th scope="col" width="250">Rating</th>
            <th scope="col" width="250" class="text-center">Lessons</th>
            <th scope="col" width="80" class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
        
        @foreach($courses as $course)
        @php  $avg_rating  = Course::avg_rating($course->course->id) @endphp
        <tr>
          <td>{{ $count++ }}</td>
          <td>{{ $course->course->name}} <br>
            <em>{{ $course->course->summary }}</em></td>
          <td>@if($avg_rating > 0)
            @for($i = 1; $i<=$avg_rating; $i++) <i class="fa fa-star text-warning" aria-hidden="true"></i> @endfor @else <i class="fa fa-star-o text-warning"></i> <i class="fa fa-star-o text-warning"></i> <i class="fa fa-star-o text-warning"></i> <i class="fa fa-star-o text-warning"></i> <i class="fa fa-star-o text-warning"></i> @endif
            <?php /*?><i class="fa fa-star text-warning my-auto"></i><?php */?></td>
          <td class="text-center"><i class="fa fa-leanpub" aria-hidden="true"></i> {{ count($course->course->lessons) }} Lessons </td>
          <td class="text-center"><a href="{{ route('student-course-detail', Crypt::encryptString($course->course->id))}}"
                                class="btn btn-sm btn-warning rounded-pill"><span class="icon"><i
                                        class='bx bxs-low-vision'></i></span></a></td>
        </tr>
        @endforeach
          </tbody>
        
      </table>
      @else
      <div class="alert alert-info" role="alert"> No course. </div>
      @endif </div>
  </div>
  @include('student.includes.footer') </div>
@endsection
@section('footer-scripts')

@endsection