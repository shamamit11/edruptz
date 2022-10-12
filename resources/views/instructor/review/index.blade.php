@php
use App\Models\Course;
use App\Models\CourseReview;
@endphp
@extends('instructor.layout')
@section('content')
<div class="main-content d-flex flex-column"> 
    @include('instructor.includes.top-nav')
    <div class="breadcrumb-area">
        <h1>Course Reviews</h1>
        <ol class="breadcrumb">
            <li class="item"><a href="{{ route('instructor-dashboard')}}"><i class='bx bx-home-alt'></i></a></li>
            <li class="item">Reviews</li>
        </ol>
    </div>
    <div class="card mb-10">
        <div class="card-body"> 
          @include('instructor.includes.alert')
            @if($reviews->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" width="50">#</th>
                        <th scope="col" width="250">Course</th>
                        <th scope="col">Review By</th>
                        <th scope="col" class="text-center" width="250">Rating</th>
                        <th scope="col"class="text-center" width="180">Reply Status</th>
                        <th scope="col" width="100" style="text-align: center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reviews as $row)
                    <tr id="tr{{ $row->id }}">
                        <td class="align-middle">{{ $count++ }}</td>
                        <td class="align-middle">{{ $row->course->name }} </td>
                        <td class="align-middle">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>{{ $row->student->name }}</div>
                            </div>
                        </td>
                        <td class="align-middle text-center">
                            @if($row->rating > 0)
                                @for($i=1; $i<=$row->rating; $i++)
                                    <i class="bx bxs-star"></i>
                                @endfor
                            @else
                                <span class="btn btn-sm btn-outline-secondary rounded-pill">No Rating</button>
                            @endif
                        </td>
                        <td class="align-middle text-center" @if($row->reply) id="tr{{ $row->reply->id }}"  @endif>
                            @if($row->reply) 
                                <span class="btn btn-sm btn-success rounded-pill">Replied</span>
                            @endif
                        </td>
                        
                        <td class="align-middle" style="text-align: center"><a href="{{route('instructor-review-reply', ['id='.Crypt::encryptString($row->id)])}}"
                                class="btn btn-sm btn-warning rounded-pill"><span class="icon"><i class="bx bxs-pencil"></i></span></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    Showing {{ $from_data }} to {{ $to_data }} of {{ $reviews->total() }} records.
                </div>
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <div class="float-end"> {{$reviews->links('pagination::bootstrap-4')}} </div>
                </div>
            </div>
            @else
            <div class="alert alert-info" role="alert"> No data found. </div>
            @endif
        </div>
    </div>
    @include('instructor.includes.footer')
</div>
@endsection
@section('footer-scripts')

@endsection