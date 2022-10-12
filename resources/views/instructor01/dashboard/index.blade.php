@extends('instructor.layout')
@section('content')
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header"> @include('instructor.includes.header')
  <div class="app-main"> @include('instructor.includes.nav')
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
          <h5>Good Morning, <a class="userName" href="{{ $user->slug }}">{{ $user->name }}</a></h5>
          <div class="subText">Here is your Edruptz account summary</div>
        </div>
        <div class="appDetailPort withPPic">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card proSummery">
                <div class="profilePicBox"> <a href="{{ $user->slug }}">
                 @if($user && $user->image)
                 
                 <img src="{{asset('/storage/uploads/instructor/'.$user->image)}}" />
                 @else
                <img src="{{asset('assets/images/profile.svg')}}" alt="" /> @endif
                                            </a> </div>
                <div class="totalCount">
                  <h5>Number of Courses: <a
                                            href="{{ route('instructor-course') }}">{{ $courses->count() }}</a></h5>
                  <h6 class="text-muted mb-1">Instructor Rating</h6>
                  <div class="rating mb-2">@if($avg_rating > 0)
                    @for($i = 1; $i<=$avg_rating; $i++) <i class="fa fa-star text-warning" aria-hidden="true"></i> @endfor @else <i class="fa fa-star-o text-warning"></i> <i class="fa fa-star-o text-warning"></i> <i class="fa fa-star-o text-warning"></i> <i class="fa fa-star-o text-warning"></i> <i class="fa fa-star-o text-warning"></i> @endif</div>
                </div>
                <div class="proSInner">
                  <ul class="psList listNocommom">
                    <li>Membership From: {{ date('d M Y', strtotime($user->created_at)) }}</li>
                  </ul>
                </div>
<?php /*?>                <button onClick="window.location='{{ route('instructor-course') }}'"
                                    class="lPointList"><i class="iconBox"><img
                                            src="{{ asset('assets/images/courses.svg') }}" alt="" /></i> <span
                                        class="btnTxt">Courses list</span> <i class="rightArrow pull-right"><img
                                            src="{{ asset('assets/images/arrow-right-white.svg') }}"
                                            alt="" /></i></button><?php */?>
              </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12">
              <div class="allSummary">
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card">
                      <div class="iconBox"><img src="../assets/images/courses.svg" alt="" /></div>
                      <p>Total Courses</p>
                      <a>{{ $courses->count() }}</a> </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card">
                      <div class="iconBox"><img src="../assets/images/sales.svg" alt="" /></div>
                      <p>Total Sales</p>
                      <a>{{ $sales->count() }}</a> </div>
                  </div>
                  <?php /*?><div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card">
                      <div class="iconBox"><img src="../assets/images/transaction.svg" alt="" /> </div>
                      <p>Remaining Payout</p>
                      <a>{{ $courses->count() }}</a> </div>
                  </div><?php */?>
                </div>
              </div>
              @if($courses->count() > 0)
              <div class="redeemYorGift">
                <div class="row"> @foreach($courses as $course)
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card mb-4">
                      <div class="catWP">
                        <div class="cwpIco"><a href="{{route('instructor-course-add', ['id='. Crypt::encryptString($course->id)])}}"
                                                        class="avatar avatar-lg avatar-4by3 mb-3 w-xs-plus-down-100 mr-sm-3"> @if($course->image) <img src="{{ asset('storage/uploads/course/'.$course->image)}}"> @else <img src="{{ asset('assets/images/no-course-image.png')}}"> @endif</a></div>
                        <div class="cwpTnP">
                          <h4><a
                                                            href="{{route('instructor-course-add', ['id='. Crypt::encryptString($course->id)])}}">{{ $course->name }}</a> </h4>
                          <a
                                                        href="{{route('instructor-lesson', ['course_id='. Crypt::encryptString($course->id)])}}">({{count($course->lessons)}})
                          Lessons</a> </div>
                      </div>
                    </div>
                  </div>
                  @endforeach </div>
              </div>
              @endif </div>
          </div>
          <?php /*?><div class="row card-nopadding mt-4">
            <div class="col-md-12 col-lg-6">
              <div class="mb-3 card">
                <div class="card-header-tab card-header-tab-animation card-header">
                  <div class="card-header-title"> <i
                                            class="fa fa-bar-chart icon-gradient bg-love-kiss mr-2"
                                            aria-hidden="true"></i> Sales Report </div>
                  <ul class="nav">
                    <li class="nav-item"><a href="javascript:void(0);"
                                                class="active nav-link">Last</a></li>
                    <li class="nav-item"><a href="javascript:void(0);"
                                                class="nav-link second-tab-toggle">Current</a></li>
                  </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="tab-pane fade show active" id="tabs-eg-77">
                      <div class="card mb-3 widget-chart widget-chart2 text-left w-100">
                        <div class="widget-chat-wrapper-outer">
                          <div
                                                        class="widget-chart-wrapper widget-chart-wrapper-lg opacity-10 m-0">
                            <div class="chartjs-size-monitor"
                                                            style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                              <div class="chartjs-size-monitor-expand"
                                                                style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div
                                                                    style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"> </div>
                              </div>
                              <div class="chartjs-size-monitor-shrink"
                                                                style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div
                                                                    style="position:absolute;width:200%;height:200%;left:0; top:0"> </div>
                              </div>
                            </div>
                            <canvas id="canvas"
                                                            style="display: block; height: 267px; width: 535px;"
                                                            width="1337" height="667"
                                                            class="chartjs-render-monitor"></canvas>
                          </div>
                        </div>
                      </div>
                      <h6
                                                class="text-muted text-uppercase font-size-md opacity-5 font-weight-normal"> Top Students</h6>
                      <div class="scroll-area-md">
                        <div class="scrollbar-container ps ps--active-y">
                          <ul
                                                        class="rm-list-borders rm-list-borders-scroll list-group list-group-flush">
                            <li class="list-group-item">
                              <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                  <div class="widget-content-left mr-3"> <img
                                                                            width="42" class="rounded-circle"
                                                                            src="../assets/images/1.jpg" alt=""> </div>
                                  <div class="widget-content-left">
                                    <div class="widget-heading">Ella-Rose Henry </div>
                                    <div class="widget-subheading">Web Developer </div>
                                  </div>
                                  <div class="widget-content-right">
                                    <div class="font-size-xlg text-muted"> <small
                                                                                class="opacity-5 pr-1">$</small> <span>129</span> <small
                                                                                class="text-danger pl-2"> <i
                                                                                    class="fa fa-angle-down"></i> </small> </div>
                                  </div>
                                </div>
                              </div>
                            </li>
                            <li class="list-group-item">
                              <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                  <div class="widget-content-left mr-3"> <img
                                                                            width="42" class="rounded-circle"
                                                                            src="../assets/images/2.jpg" alt=""> </div>
                                  <div class="widget-content-left">
                                    <div class="widget-heading">Ruben Tillman</div>
                                    <div class="widget-subheading">UI Designer</div>
                                  </div>
                                  <div class="widget-content-right">
                                    <div class="font-size-xlg text-muted"> <small
                                                                                class="opacity-5 pr-1">$</small> <span>54</span> <small
                                                                                class="text-success pl-2"> <i
                                                                                    class="fa fa-angle-up"></i> </small> </div>
                                  </div>
                                </div>
                              </div>
                            </li>
                            <li class="list-group-item">
                              <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                  <div class="widget-content-left mr-3"> <img
                                                                            width="42" class="rounded-circle"
                                                                            src="../assets/images/3.jpg" alt=""> </div>
                                  <div class="widget-content-left">
                                    <div class="widget-heading">Vinnie Wagstaff </div>
                                    <div class="widget-subheading">Java Programmer </div>
                                  </div>
                                  <div class="widget-content-right">
                                    <div class="font-size-xlg text-muted"> <small
                                                                                class="opacity-5 pr-1">$</small> <span>429</span> <small
                                                                                class="text-warning pl-2"> <i
                                                                                    class="fa fa-dot-circle"></i> </small> </div>
                                  </div>
                                </div>
                              </div>
                            </li>
                            <li class="list-group-item">
                              <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                  <div class="widget-content-left mr-3"> <img
                                                                            width="42" class="rounded-circle"
                                                                            src="../assets/images/4.jpg" alt=""> </div>
                                  <div class="widget-content-left">
                                    <div class="widget-heading">Ella-Rose Henry </div>
                                    <div class="widget-subheading">Web Developer </div>
                                  </div>
                                  <div class="widget-content-right">
                                    <div class="font-size-xlg text-muted"> <small
                                                                                class="opacity-5 pr-1">$</small> <span>129</span> <small
                                                                                class="text-danger pl-2"> <i
                                                                                    class="fa fa-angle-down"></i> </small> </div>
                                  </div>
                                </div>
                              </div>
                            </li>
                            <li class="list-group-item">
                              <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                  <div class="widget-content-left mr-3"> <img
                                                                            width="42" class="rounded-circle"
                                                                            src="../assets/images/1.jpg" alt=""> </div>
                                  <div class="widget-content-left">
                                    <div class="widget-heading">Ruben Tillman</div>
                                    <div class="widget-subheading">UI Designer</div>
                                  </div>
                                  <div class="widget-content-right">
                                    <div class="font-size-xlg text-muted"> <small
                                                                                class="opacity-5 pr-1">$</small> <span>54</span> <small
                                                                                class="text-success pl-2"> <i
                                                                                    class="fa fa-angle-up"
                                                                                    aria-hidden="true"></i> </small> </div>
                                  </div>
                                </div>
                              </div>
                            </li>
                          </ul>
                          <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                            <div class="ps__thumb-x" tabindex="0"
                                                            style="left: 0px; width: 0px;"></div>
                          </div>
                          <div class="ps__rail-y"
                                                        style="top: 0px; height: 200px; right: 0px;">
                            <div class="ps__thumb-y" tabindex="0"
                                                            style="top: 0px; height: 139px;"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-lg-6">
              <div class="card-hover-shadow-2x mb-3 card">
                <div class="card-header"><i class="fa fa-comments-o icon-gradient bg-love-kiss mr-2"
                                        aria-hidden="true"></i> Chat Box</div>
                <div class="scroll-area-md">
                  <div class="scrollbar-container ps ps--active-y">
                    <div class="p-2">
                      <div class="chat-wrapper p-1">
                        <div class="chat-box-wrapper">
                          <div>
                            <div class="avatar-icon-wrapper mr-1">
                              <div
                                                                class="badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg"> </div>
                              <div class="avatar-icon avatar-icon-lg rounded"> <img
                                                                    src="../assets/images/2.jpg" alt=""> </div>
                            </div>
                          </div>
                          <div>
                            <div class="chat-box">But I must explain to you how all this
                              mistaken
                              idea of denouncing pleasure and praising pain was born and I
                              will
                              give you a complete account of the system.</div>
                            <small class="opacity-6"> <i
                                                                class="fa fa-calendar-alt mr-1"></i> 11:01 AM |
                            Yesterday </small> </div>
                        </div>
                        <div class="float-right">
                          <div class="chat-box-wrapper chat-box-wrapper-right">
                            <div>
                              <div class="chat-box">Expound the actual teachings of the
                                great
                                explorer of the truth, the master-builder of human
                                happiness. </div>
                              <small class="opacity-6"> <i
                                                                    class="fa fa-calendar-alt mr-1"></i> 11:01 AM |
                              Yesterday </small> </div>
                            <div>
                              <div class="avatar-icon-wrapper ml-1">
                                <div
                                                                    class="badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg"> </div>
                                <div class="avatar-icon avatar-icon-lg rounded"> <img
                                                                        src="../assets/images/3.jpg" alt=""> </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="chat-box-wrapper">
                          <div>
                            <div class="avatar-icon-wrapper mr-1">
                              <div
                                                                class="badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg"> </div>
                              <div class="avatar-icon avatar-icon-lg rounded"> <img
                                                                    src="../assets/images/2.jpg" alt=""> </div>
                            </div>
                          </div>
                          <div>
                            <div class="chat-box">But I must explain to you how all this
                              mistaken
                              idea of denouncing pleasure and praising pain was born and I
                              will
                              give you a complete account of the system.</div>
                            <small class="opacity-6"> <i
                                                                class="fa fa-calendar-alt mr-1"></i> 11:01 AM |
                            Yesterday </small> </div>
                        </div>
                        <div class="float-right">
                          <div class="chat-box-wrapper chat-box-wrapper-right">
                            <div>
                              <div class="chat-box">Denouncing pleasure and praising pain
                                was born
                                and I will give you a complete account.</div>
                              <small class="opacity-6"> <i
                                                                    class="fa fa-calendar-alt mr-1"></i> 11:01 AM |
                              Yesterday </small> </div>
                            <div>
                              <div class="avatar-icon-wrapper ml-1">
                                <div
                                                                    class="badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg"> </div>
                                <div class="avatar-icon avatar-icon-lg rounded"> <img
                                                                        src="../assets/images/2.jpg" alt=""> </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="float-right">
                          <div class="chat-box-wrapper chat-box-wrapper-right">
                            <div>
                              <div class="chat-box">The master-builder of human happiness. </div>
                              <small class="opacity-6"> <i
                                                                    class="fa fa-calendar-alt mr-1"></i> 11:01 AM |
                              Yesterday </small> </div>
                            <div>
                              <div class="avatar-icon-wrapper ml-1">
                                <div
                                                                    class="badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg"> </div>
                                <div class="avatar-icon avatar-icon-lg rounded"> <img
                                                                        src="../assets/images/2.jpg" alt=""> </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="ps__rail-x" style="left: 0px; bottom: -408px;">
                      <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                    </div>
                    <div class="ps__rail-y" style="top: 408px; height: 200px; right: 0px;">
                      <div class="ps__thumb-y" tabindex="0" style="top: 134px; height: 65px;"> </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <input placeholder="Write here and hit enter to send..." type="text"
                                        class="form-control-sm form-control">
                </div>
              </div>
              <div class="tpfBox">
                <div class="card mb-2 widget-content">
                  <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                      <div class="widget-content-left">
                        <div class="widget-heading">Total Orders</div>
                        <div class="widget-subheading">Last year expenses</div>
                      </div>
                      <div class="widget-content-right">
                        <div class="widget-numbers text-success">1896</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card mb-2 widget-content">
                  <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                      <div class="widget-content-left">
                        <div class="widget-heading">Products Sold</div>
                        <div class="widget-subheading">Revenue streams</div>
                      </div>
                      <div class="widget-content-right">
                        <div class="widget-numbers text-warning">$3M</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card mb-0 widget-content">
                  <div class="widget-content-outer">
                    <div class="widget-content-wrapper">
                      <div class="widget-content-left">
                        <div class="widget-heading">Followers</div>
                        <div class="widget-subheading">People Interested</div>
                      </div>
                      <div class="widget-content-right">
                        <div class="widget-numbers text-danger">45,9%</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><?php */?>
          <?php /*?><div class="row card-nopadding mt-1">
            <div class="col-md-12">
              <div class="main-card  card">
                <div class="card-header"><i class="fa fa-list icon-gradient bg-love-kiss mr-2"
                                        aria-hidden="true"></i> Recent Orders
                  <div class="btn-actions-pane-right">
                    <div role="group" class="btn-group-sm btn-group">
                      <button class="active btn btn-focus">Last Week</button>
                      <button class="btn btn-focus">All Month</button>
                    </div>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                    <thead>
                      <tr>
                        <th class="text-center">#</th>
                        <th>Name</th>
                        <th class="text-center">Amount</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center text-muted">#345</td>
                        <td><div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                              <div class="widget-content-left mr-3">
                                <div class="widget-content-left"> <img width="40"
                                                                        class="rounded-circle"
                                                                        src="../assets/images/4.jpg" alt=""> </div>
                              </div>
                              <div class="widget-content-left flex2">
                                <div class="widget-heading">John Doe</div>
                                <div class="widget-subheading opacity-7">Web Developer </div>
                              </div>
                            </div>
                          </div></td>
                        <td class="text-center">USD2995</td>
                        <td class="text-center"><div class="badge badge-warning">Pending</div></td>
                        <td class="text-center"><button type="button" id="PopoverCustomT-1"
                                                        class="btn btn-primary btn-sm">Details</button></td>
                      </tr>
                      <tr>
                        <td class="text-center text-muted">#347</td>
                        <td><div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                              <div class="widget-content-left mr-3">
                                <div class="widget-content-left"> <img width="40"
                                                                        class="rounded-circle"
                                                                        src="../assets/images/3.jpg" alt=""> </div>
                              </div>
                              <div class="widget-content-left flex2">
                                <div class="widget-heading">Ruben Tillman</div>
                                <div class="widget-subheading opacity-7">Etiam sit amet
                                  orci eget</div>
                              </div>
                            </div>
                          </div></td>
                        <td class="text-center">USD2995</td>
                        <td class="text-center"><div class="badge badge-success">Completed</div></td>
                        <td class="text-center"><button type="button" id="PopoverCustomT-2"
                                                        class="btn btn-primary btn-sm">Details</button></td>
                      </tr>
                      <tr>
                        <td class="text-center text-muted">#321</td>
                        <td><div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                              <div class="widget-content-left mr-3">
                                <div class="widget-content-left"> <img width="40"
                                                                        class="rounded-circle"
                                                                        src="../assets/images/2.jpg" alt=""> </div>
                              </div>
                              <div class="widget-content-left flex2">
                                <div class="widget-heading">Elliot Huber</div>
                                <div class="widget-subheading opacity-7">Lorem ipsum
                                  dolor sic</div>
                              </div>
                            </div>
                          </div></td>
                        <td class="text-center">USD2995</td>
                        <td class="text-center"><div class="badge badge-danger">In Progress</div></td>
                        <td class="text-center"><button type="button" id="PopoverCustomT-3"
                                                        class="btn btn-primary btn-sm">Details</button></td>
                      </tr>
                      <tr>
                        <td class="text-center text-muted">#55</td>
                        <td><div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                              <div class="widget-content-left mr-3">
                                <div class="widget-content-left"> <img width="40"
                                                                        class="rounded-circle"
                                                                        src="../assets/images/1.jpg" alt=""></div>
                              </div>
                              <div class="widget-content-left flex2">
                                <div class="widget-heading">Vinnie Wagstaff</div>
                                <div class="widget-subheading opacity-7">UI Designer </div>
                              </div>
                            </div>
                          </div></td>
                        <td class="text-center">USD2995</td>
                        <td class="text-center"><div class="badge badge-info">On Hold</div></td>
                        <td class="text-center"><button type="button" id="PopoverCustomT-4"
                                                        class="btn btn-primary btn-sm">Details</button></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                
              </div>
            </div>
          </div><?php */?>
        </div>
      </div>
      @include('instructor.includes.footer') </div>
  </div>
</div>
@endsection