@php use App\Models\Instructor; @endphp
@extends('site.layout')
@section('content')
    <main class="main" style="background-color:#fff;">
        <section class="innerBanner">
            <div class="ibPic"><img src="{{ asset('assets/images/courses-banner.jpg') }}" alt="" /></div>
            <div class="overlay"></div>
            <div class="ibCont text-center txtwhite">
                <h1>{{ $row->name }}</h1>
                <p class="corseCate">{{ $row->category->name }}</p>
            </div>
        </section>
        <section class="mt-5 mb-5">
            <div class="container">
                <div class="row gx-5" s>
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        @if ($row->image)
                            <div class="courseSingleBanner"><img src="{{ asset('storage/uploads/course/' . $row->image) }}"
                                    alt="" /></div>
                        @endif
                        <div class="courseDetails mt-4">
                            <nav>
                                <div class="nav nav-pills" id="nav-tab" role="tablist">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#nav-description"
                                        type="button" role="tab" aria-controls="nav-description"
                                        aria-selected="true">Description</button>
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-lessons"
                                        type="button" role="tab" aria-controls="nav-lessons"
                                        aria-selected="false">Lessons</button>
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-reviews"
                                        type="button" role="tab" aria-controls="nav-reviews"
                                        aria-selected="false">Reviews
                                        ({{ count($row->reviews) }})</button>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-description" role="tabpanel"
                                    aria-labelledby="nav-description-tab"> {!! $row->description !!} </div>
                                <div class="tab-pane fade" id="nav-lessons" role="tabpanel"
                                    aria-labelledby="nav-lessons-tab">
                                    @if (count($row->lessons) > 0)
                                        <ul class="lessonStep">
                                            @foreach ($row->lessons as $lesson)
                                                <li>
                                                    <div class="stepNo">
                                                        <p>{{ $count }}</p>
                                                    </div>
                                                    <div class="stepDetails">
                                                        <h4>{{ $lesson->name }}</h4>
                                                        <div> {{ $lesson->summary }}</div>
                                                    </div>
                                                </li>
                                                @php $count++; @endphp
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="nav-reviews" role="tabpanel"
                                    aria-labelledby="nav-reviews-tab">
                                    @if (count($row->reviews) > 0)
                                        <ul class="reviewList">
                                            @foreach ($row->reviews as $review)
                                                <li>
                                                    <div class="reviewPic">
                                                        @if ($review->student->image)
                                                            <img src="{{ asset('storage/uploads/student/' . $review->student->image) }}"
                                                                alt="">
                                                        @else
                                                            <img src="{{ asset('assets/images/teacher.png') }}"
                                                                alt="">
                                                        @endif
                                                    </div>
                                                    <div class="reviewDetails">
                                                        <div class="titleWithRatings">
                                                            <h4>{{ $review->student->name }}</h4>
                                                            <div class="small-ratings">
                                                                @for ($i = 1; $i <= $review->rating; $i++)
                                                                    <i class="fa fa-star rating-color"></i>
                                                                @endfor
                                                                @if ($review->rating < 5)
                                                                    @for ($i = $review->rating + 1; $i <= 5; $i++)
                                                                        <i class="fa fa-star"></i>
                                                                    @endfor
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <p>{!! nl2br($review->description) !!}</p>
                                                        @if ($review->reply && $review->reply->description)
                                                            <div><i class="fa fa-comment"></i> {!! nl2br($review->reply->description) !!}</div>
                                                        @endif
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="erollandShare  mb-3">
                            <ul class="btnList">
                                <li class="d-none d-sm-block">
                                    <form action="{{ route('cart-add') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="course_id" value="{{ $row->id }}">
                                        <button type="submit" class="btn btn-blue2">Enroll Now</button>
                                    </form>
                                <li>{!! $share_buttons !!}</li>
                                <!-- <li><a class="btnBlue" href="#">Share Course</a></li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="priceEnroll flex-center space-between">
                            <div class="coursePrice ">
                                <h1><span class="currency">USD</span> {{ $row->amount }}</h1>
                            </div>
                            <div class="enrollBtn">
                                <form action="{{ route('cart-add') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $row->id }}">
                                    <button type="submit" class="btn btn-blue2">Enroll Now</button>
                                </form>
                            </div>
                        </div>
                        <div class="courseFeatures mt-4">
                            <h2>Course Features</h2>
                            <div class="cfRow">
                                <div class="cfInner">
                                    <h4><i class="fa fa-clock-o" aria-hidden="true"></i> Duration</h4>
                                </div>
                                <div class="cfInner">
                                    <p>{{ $row->duration }}</p>
                                </div>
                            </div>
                            <div class="cfRow">
                                <div class="cfInner">
                                    <h4><i class="fa fa-book" aria-hidden="true"></i> Lectures</h4>
                                </div>
                                <div class="cfInner">
                                    <p>{{ $row->lectures }}</p>
                                </div>
                            </div>
                            <div class="cfRow">
                                <div class="cfInner">
                                    <h4><i class="fa fa-graduation-cap" aria-hidden="true"></i> Students Enrolled</h4>
                                </div>
                                <div class="cfInner">
                                    <p>{{ count($row->sales) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="teacherCards ">

                            @php
                            $total_students = 0;
                            $avg_rating = Instructor::avg_rating($row->instructor->id); @endphp
                            @if (count($row->instructor->courses) > 0)
                                @foreach ($row->instructor->courses as $course)
                                    @php $total_students = $total_students + $course->sales->count(); @endphp
                                @endforeach
                            @endif

                            <div class="card">
                                <div class="d-flex align-items-center">
                                    <div class="image">
                                        @if ($row->instructor->image)
                                            <img src="{{ asset('storage/uploads/instructor/' . $row->instructor->image) }}"
                                                class="rounded" width="155">
                                        @else
                                            <img src="{{ asset('assets/images/teacher.png') }}" class="rounded"
                                                width="155">
                                        @endif
                                    </div>
                                    <div class="ml-3 w-100">
                                        <h3 class="mb-2 mt-0">{{ $row->instructor->name }}</h3>
                                        <h4>{{ $row->instructor->professional }}</h4>
                                        <div
                                            class="mt-2 bg-primary d-flex justify-content-between rounded text-white stats ">
                                            <div class="d-flex flex-column dtls-bdr"> <span
                                                    class="articles">Courses</span> <span
                                                    class="number1">{{ count($row->instructor->courses) }}</span> </div>
                                            <div class="d-flex flex-column dtls-bdr"> <span
                                                    class="followers">Students</span> <span class="number2">
                                                    {{ $total_students }}</span> </div>
                                            <div class="d-flex flex-column dtls-bdr"> <span class="rating">Rating</span>
                                                <span class="number3">{{ $avg_rating }}</span> </div>
                                        </div>
                                        <!--<ul class="socialList">
         <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
         <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
         <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
         <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
         <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
        </ul>
                    <div class="button mt-2 d-flex flex-row align-items-center"> <button class="btn btn-sm btn-outline-green  w-100">Chat</button> <button class="btn btn-sm btn-green ms-2 w-100">Follow</button> </div>-->
                                        <div class="button mt-2 d-flex flex-row align-items-center"> <a
                                                class="btn btn-sm btn-blue2 w-100"
                                                href="{{ $row->instructor->slug }}">View Profile</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @if ($related_courses->count() > 0)
            <section>
                <div class="container  mb-4">
                    <div class="titleWithAllbtn">
                        <h1 class="txtBlue">You may be interested in these courses</h1>
                    </div>
                    <div class="bestseller owl-theme owl-carousel">
                        @foreach ($related_courses as $course)
                            <div class="card-container">
                                <div class="card">
                                    <div class="cardPic"> <a href="{{ $course->slug }}">
                                            <picture>
                                                @if ($course->image)
                                                    <img src="{{ asset('storage/uploads/course/' . $course->image) }}"
                                                        alt="" />
                                                @else
                                                    <img src="{{ asset('assets/images/no-course-image') }}"
                                                        class="card-img img-fluid">
                                                @endif
                                            </picture>
                                        </a> <a class="categoryBag"
                                            href="{{ route($course->category->slug) }}">{{ $course->category->name }}</a>
                                    </div>
                                    <div class="card-block">
                                        <h3 class="card-title"><a class="courseTitle"
                                                href="{{ $course->slug }}">{{ $course->name }}</a></h3>
                                        <a class="courseAuthor"
                                            href="{{ $course->instructor->slug }}">{{ $course->instructor->name }}</a>
                                        <p class="card-text">{{ $course->summary }}</p>
                                        <ul class="courseSMList">
                                            <li><i class="fa fa-user-circle" aria-hidden="true"></i>
                                                {{ $course->sales->count() }}
                                                Student(s)</li>
                                            <li><i class="fa fa-star" aria-hidden="true"></i> 0 Ratings</li>
                                            <li>USD {{ $course->amount }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </main>
@endsection
@section('footer-scripts')
  <?php /*?>  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" /><?php */?>
    <style>
        ul.btnList ul {
            width: 100% !important;
        }

        ul.btnList li a {
            width: auto
        }

        div#social-links {
            margin: 0 auto;
            max-width: 500px;
        }

        div#social-links ul li {
            display: inline-block;
        }

        div#social-links ul li a {
            margin: 0 4px;
            font-size: 48px;
            color: #0cbfc9;
        }
    </style>
@endsection
