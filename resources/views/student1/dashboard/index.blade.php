@extends('student.layout')
@section('content')
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header"> @include('student.includes.header')
  <div class="app-main"> @include('student.includes.nav')
    <div class="app-main__outer">
      <div class="app-main__inner">
        <div class="app-page-title onlyOnMobile">
          <div class="page-title-wrapper">
            <div class="page-title-heading">
              <h4>Welcome to Edruptz!</h4>
            </div>
          </div>
        </div>
        <div class="userWelcome">
          <h5>Good Morning, <a class="userName" href="#">{{ $user->name }}</a></h5>
          <div class="subText">Here is your Edruptz account summary</div>
        </div>
        <div class=" withPPic">
          <div class="row mt-4">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <?php /*?> <div class="advPort ">
                <div class="advWrapper">
                  <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 text-white">
                      <h4>Join Now and Get Discount<br/>
                        Voucher Up To 20%</h4>
                      <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <div class="advpic"><img src="../assets/images/student.png" alt=""/></div>
                    </div>
                  </div>
                </div>
              </div>
           <div class="row allSummary mt-4">
                <div class="col-md-6 col-xl-4">
                  <div class="card mb-3 widget-content bg-midnight-bloom ">
                    <div class="text-white mx-auto text-center">
                      <div class="iconBox"><img src="../assets/images/courses.svg" alt=""></div>
                      <a href="#">13</a>
                      <p>Completed<br/>
                        Courses</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-xl-4">
                  <div class="card mb-3 widget-content bg-arielle-smile">
                    <div class="text-white mx-auto text-center">
                      <div class="iconBox"><img src="../assets/images/courses.svg" alt=""></div>
                      <a href="#">19</a>
                      <p>In Progress<br/>
                        Courses</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-xl-4">
                  <div class="card mb-3 widget-content bg-grow-early">
                    <div class="text-white mx-auto text-center">
                      <div class="iconBox"><img src="../assets/images/courses.svg" alt=""></div>
                      <a href="#">11</a>
                      <p>Upcoming<br/>
                        Courses</p>
                    </div>
                  </div>
                </div>
                <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
                  <div class="card mb-3 widget-content bg-premium-dark">
                    <div class="widget-content-wrapper text-white">
                      <div class="widget-content-left">
                        <div class="widget-heading">Products Sold</div>
                        <div class="widget-subheading">Revenue streams</div>
                      </div>
                      <div class="widget-content-right">
                        <div class="widget-numbers text-warning"><span>$14M</span></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div><?php */?>
              @if($courses->count() > 0)
              <div class="card cardAlt mt-4">
                <div class="card-header-tab card-header-tab-animation card-header">
                  <div class="card-header-title"> <i class="fa fa-list icon-gradient bg-love-kiss mr-2" aria-hidden="true"></i> Courses </div>
                </div>
                <ul class="list-group list-group-fit couresList mb-0" style="z-index: initial;">
                 @foreach($courses as $course)
                  @php 
              $reading_percent = 0; 
              @endphp
              @if(count($course->course->lessons) > 0)
                 @foreach($course->course->lessons as $lesson)
                  @if($lesson->status == 1)
                  @php  $reading_percent = $reading_percent + round((100/count($course->course->lessons)), 2); @endphp
                  @endif
                    @endforeach
                      @endif
                  <li class="list-group-item" style="z-index: initial;">
                    <div class="d-flex align-items-center"><a href="{{ route('student-course-detail', Crypt::encryptString($course->course->id))}}" class="avatar avatar-4by3 avatar-sm mr-3">  @if($course->course->image) <img src="{{ asset('storage/uploads/course/'.$course->course->image) }}"  class="avatar-img rounded"/> @else <img src="{{ asset('assets/images/no-course-image') }}"  class="avatar-img rounded"> @endif  </a>
				
                      <div class="flex"> <a href="{{ route('student-course-detail', Crypt::encryptString($course->course->id))}}" class="text-body"><strong>{{ $course->course->name}}</strong></a>
                        <div class="d-flex align-items-center">
                          <div class="progress" style="width: 80%;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $reading_percent }}%" aria-valuenow="{{ $reading_percent }}" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                          <small class="text-muted ml-2">{{ $reading_percent }}%</small> </div>
                      </div>
                      <div class="dropdown ml-3"> <a href="{{ route('student-course-detail', Crypt::encryptString($course->course->id))}}">View Details</a> </div>
                    </div>
                  </li>
                   @endforeach
                </ul>
              </div>
              @endif </div>
            <div class="col-lg-4 col-md-4 col-sm-12"> </div>
          </div>
        </div>
      </div>
      @include('student.includes.footer') </div>
  </div>
</div>
@endsection 