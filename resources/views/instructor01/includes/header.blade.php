<div class="app-header header-shadow">
    <div class="app-header__logo">
      <div class="logo-src"><a href="{{ route('/') }}"><img src="{{asset('assets/images/edruptz.svg')}}" alt=""/></a></div>
      <div class="header__pane ml-auto hideonMobile">
        <div>
          <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar"> <span class="hamburger-box"> <span class="hamburger-inner"></span> </span> </button>
        </div>
      </div>
    </div>
    <div class="app-header__mobile-menu">
      <div>
        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav"> <span class="hamburger-box6"> <span class="hamburger-inner"></span> </span> </button>
      </div>
    </div>
    <div class="app-header__content">
      <div class="app-header-left">
        <h4>Welcome to Your EDRUPTZ Dashboard!</h4>
      </div>
      <div class="app-header-right">
        <?php /*?><div class="dropdown">
          <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="p-0 mr-5 btn btn-link"> <span class="icon-wrapper icon-wrapper-alt rounded-circle"> <i class="fa fa-bell-o fa-2 text-danger icon-anim-pulse ion-android-notifications"></i> <span class="badge badge-dot badge-dot-sm badge-danger">Notifications</span> </span> </button>
          <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-xl rm-pointers dropdown-menu dropdown-menu-right top0" style="">
            <div class="dropdown-menu-header mb-0">
              <div class="dropdown-menu-header-inner bg-deep-blue">
                <div class="menu-header-image opacity-1" style="background-image: url('{{asset('assets/images/dropdown-header/city3.jpg')}}');"></div>
                <div class="menu-header-content text-dark">
                  <h5 class="menu-header-title">Notifications</h5>
                  <h6 class="menu-header-subtitle">You have <b>21</b> unread messages</h6>
                </div>
              </div>
            </div>
            <ul class="tabs-animated-shadow tabs-animated nav nav-justified tabs-shadow-bordered p-3">
              <li class="nav-item"> <a role="tab" class="nav-link active" data-toggle="tab" href="#tab-messages-header" aria-selected="true"> <span>Messages</span> </a> </li>
              <li class="nav-item"> <a role="tab" class="nav-link" data-toggle="tab" href="#tab-events-header" aria-selected="false"> <span>Notifications</span> </a> </li>
              <li class="nav-item"> <a role="tab" class="nav-link" data-toggle="tab" href="#tab-errors-header" aria-selected="false"> <span>System Errors</span> </a> </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab-messages-header" role="tabpanel">
                <div class="scroll-area-sm">
                  <div class="scrollbar-container ps">
                    <div class="p-3">
                      <div class="notifications-box">
                        <div class="vertical-time-simple vertical-without-time vertical-timeline vertical-timeline--one-column">
                          <div class="vertical-timeline-item dot-danger vertical-timeline-element">
                            <div><span class="vertical-timeline-element-icon bounce-in"></span>
                              <div class="vertical-timeline-element-content bounce-in">
                                <h4 class="timeline-title">All Hands Meeting</h4>
                                <span class="vertical-timeline-element-date"></span> </div>
                            </div>
                          </div>
                          <div class="vertical-timeline-item dot-warning vertical-timeline-element">
                            <div> <span class="vertical-timeline-element-icon bounce-in"></span>
                              <div class="vertical-timeline-element-content bounce-in">
                                <p>Yet another one, at <span class="text-success">15:00 PM</span></p>
                                <span class="vertical-timeline-element-date"></span> </div>
                            </div>
                          </div>
                          <div class="vertical-timeline-item dot-success vertical-timeline-element">
                            <div> <span class="vertical-timeline-element-icon bounce-in"></span>
                              <div class="vertical-timeline-element-content bounce-in">
                                <h4 class="timeline-title">Build the production release <span class="badge badge-danger ml-2">NEW</span> </h4>
                                <span class="vertical-timeline-element-date"></span> </div>
                            </div>
                          </div>
                          <div class="vertical-timeline-item dot-primary vertical-timeline-element">
                            <div> <span class="vertical-timeline-element-icon bounce-in"></span>
                              <div class="vertical-timeline-element-content bounce-in">
                                <h4 class="timeline-title">Something not important
                                  <div class="avatar-wrapper mt-2 avatar-wrapper-overlap">
                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                      <div class="avatar-icon"> <img src="{{asset('assets/images/1.jpg')}}" alt=""> </div>
                                    </div>
                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                      <div class="avatar-icon"> <img src="{{asset('assets/images/2.jpg')}}" alt=""> </div>
                                    </div>
                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                      <div class="avatar-icon"> <img src="{{asset('assets/images/3.jpg')}}" alt=""> </div>
                                    </div>
                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                      <div class="avatar-icon"> <img src="{{asset('assets/images/4.jpg')}}" alt=""> </div>
                                    </div>
                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                      <div class="avatar-icon"> <img src="{{asset('assets/images/1.jpg')}}" alt=""> </div>
                                    </div>
                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                      <div class="avatar-icon"> <img src="{{asset('assets/images/2.jpg')}}" alt=""> </div>
                                    </div>
                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                      <div class="avatar-icon"> <img src="{{asset('assets/images/3.jpg')}}" alt=""> </div>
                                    </div>
                                    <div class="avatar-icon-wrapper avatar-icon-sm">
                                      <div class="avatar-icon"> <img src="{{asset('assets/images/4.jpg')}}" alt=""> </div>
                                    </div>
                                    <div class="avatar-icon-wrapper avatar-icon-sm avatar-icon-add">
                                      <div class="avatar-icon"><i>+</i></div>
                                    </div>
                                  </div>
                                </h4>
                                <span class="vertical-timeline-element-date"></span> </div>
                            </div>
                          </div>
                          <div class="vertical-timeline-item dot-info vertical-timeline-element">
                            <div> <span class="vertical-timeline-element-icon bounce-in"></span>
                              <div class="vertical-timeline-element-content bounce-in">
                                <h4 class="timeline-title">This dot has an info state</h4>
                                <span class="vertical-timeline-element-date"></span> </div>
                            </div>
                          </div>
                          <div class="vertical-timeline-item dot-danger vertical-timeline-element">
                            <div> <span class="vertical-timeline-element-icon bounce-in"></span>
                              <div class="vertical-timeline-element-content bounce-in">
                                <h4 class="timeline-title">All Hands Meeting</h4>
                                <span class="vertical-timeline-element-date"></span> </div>
                            </div>
                          </div>
                          <div class="vertical-timeline-item dot-warning vertical-timeline-element">
                            <div> <span class="vertical-timeline-element-icon bounce-in"></span>
                              <div class="vertical-timeline-element-content bounce-in">
                                <p>Yet another one, at <span class="text-success">15:00 PM</span> </p>
                                <span class="vertical-timeline-element-date"></span> </div>
                            </div>
                          </div>
                          <div class="vertical-timeline-item dot-success vertical-timeline-element">
                            <div><span class="vertical-timeline-element-icon bounce-in"></span>
                              <div class="vertical-timeline-element-content bounce-in">
                                <h4 class="timeline-title">Build the production release <span class="badge badge-danger ml-2">NEW</span> </h4>
                                <span class="vertical-timeline-element-date"></span> </div>
                            </div>
                          </div>
                          <div class="vertical-timeline-item dot-dark vertical-timeline-element">
                            <div><span class="vertical-timeline-element-icon bounce-in"></span>
                              <div class="vertical-timeline-element-content bounce-in">
                                <h4 class="timeline-title">This dot has a dark state</h4>
                                <span class="vertical-timeline-element-date"></span> </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                      <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                    </div>
                    <div class="ps__rail-y" style="top: 0px; right: 0px;">
                      <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab-events-header" role="tabpanel">
                <div class="scroll-area-sm">
                  <div class="scrollbar-container ps">
                    <div class="p-3">
                      <div class="vertical-without-time vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                        <div class="vertical-timeline-item vertical-timeline-element">
                          <div> <span class="vertical-timeline-element-icon bounce-in"> <i class="badge badge-dot badge-dot-xl badge-success"> </i> </span>
                            <div class="vertical-timeline-element-content bounce-in">
                              <h4 class="timeline-title">All Hands Meeting</h4>
                              <p>Lorem ipsum dolor sic amet, today at <a href="javascript:void(0);">12:00 PM</a> </p>
                              <span class="vertical-timeline-element-date"></span> </div>
                          </div>
                        </div>
                        <div class="vertical-timeline-item vertical-timeline-element">
                          <div> <span class="vertical-timeline-element-icon bounce-in"> <i class="badge badge-dot badge-dot-xl badge-warning"> </i> </span>
                            <div class="vertical-timeline-element-content bounce-in">
                              <p>Another meeting today, at <b class="text-danger">12:00 PM</b></p>
                              <p>Yet another one, at <span class="text-success">15:00 PM</span></p>
                              <span class="vertical-timeline-element-date"></span> </div>
                          </div>
                        </div>
                        <div class="vertical-timeline-item vertical-timeline-element">
                          <div> <span class="vertical-timeline-element-icon bounce-in"> <i class="badge badge-dot badge-dot-xl badge-danger"> </i> </span>
                            <div class="vertical-timeline-element-content bounce-in">
                              <h4 class="timeline-title">Build the production release</h4>
                              <p>Lorem ipsum dolor sit amit,consectetur eiusmdd tempor incididunt ut
                                labore et dolore magna elit enim at minim veniam quis nostrud </p>
                              <span class="vertical-timeline-element-date"></span> </div>
                          </div>
                        </div>
                        <div class="vertical-timeline-item vertical-timeline-element">
                          <div> <span class="vertical-timeline-element-icon bounce-in"> <i class="badge badge-dot badge-dot-xl badge-primary"> </i> </span>
                            <div class="vertical-timeline-element-content bounce-in">
                              <h4 class="timeline-title text-success">Something not important</h4>
                              <p>Lorem ipsum dolor sit amit,consectetur elit enim at minim veniam quis nostrud</p>
                              <span class="vertical-timeline-element-date"></span> </div>
                          </div>
                        </div>
                        <div class="vertical-timeline-item vertical-timeline-element">
                          <div> <span class="vertical-timeline-element-icon bounce-in"> <i class="badge badge-dot badge-dot-xl badge-success"> </i> </span>
                            <div class="vertical-timeline-element-content bounce-in">
                              <h4 class="timeline-title">All Hands Meeting</h4>
                              <p>Lorem ipsum dolor sic amet, today at <a href="javascript:void(0);">12:00 PM</a> </p>
                              <span class="vertical-timeline-element-date"></span> </div>
                          </div>
                        </div>
                        <div class="vertical-timeline-item vertical-timeline-element">
                          <div> <span class="vertical-timeline-element-icon bounce-in"> <i class="badge badge-dot badge-dot-xl badge-warning"> </i> </span>
                            <div class="vertical-timeline-element-content bounce-in">
                              <p>Another meeting today, at <b class="text-danger">12:00 PM</b></p>
                              <p>Yet another one, at <span class="text-success">15:00 PM</span></p>
                              <span class="vertical-timeline-element-date"></span> </div>
                          </div>
                        </div>
                        <div class="vertical-timeline-item vertical-timeline-element">
                          <div> <span class="vertical-timeline-element-icon bounce-in"> <i class="badge badge-dot badge-dot-xl badge-danger"> </i> </span>
                            <div class="vertical-timeline-element-content bounce-in">
                              <h4 class="timeline-title">Build the production release</h4>
                              <p>Lorem ipsum dolor sit amit,consectetur eiusmdd tempor incididunt ut
                                labore et dolore magna elit enim at minim veniam quis nostrud </p>
                              <span class="vertical-timeline-element-date"></span> </div>
                          </div>
                        </div>
                        <div class="vertical-timeline-item vertical-timeline-element">
                          <div> <span class="vertical-timeline-element-icon bounce-in"> <i class="badge badge-dot badge-dot-xl badge-primary"> </i> </span>
                            <div class="vertical-timeline-element-content bounce-in">
                              <h4 class="timeline-title text-success">Something not important</h4>
                              <p>Lorem ipsum dolor sit amit,consectetur elit enim at minim veniam quis nostrud</p>
                              <span class="vertical-timeline-element-date"></span> </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                      <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                    </div>
                    <div class="ps__rail-y" style="top: 0px; right: 0px;">
                      <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab-errors-header" role="tabpanel">
                <div class="scroll-area-sm">
                  <div class="scrollbar-container ps">
                    <div class="no-results pt-3 pb-0">
                      <div class="swal2-icon swal2-success swal2-animate-success-icon">
                        <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                        <span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>
                        <div class="swal2-success-ring"></div>
                        <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                        <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                      </div>
                      <div class="results-subtitle">All caught up!</div>
                      <div class="results-title">There are no system errors!</div>
                    </div>
                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                      <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                    </div>
                    <div class="ps__rail-y" style="top: 0px; right: 0px;">
                      <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <ul class="nav flex-column">
              <li class="nav-item-divider nav-item"></li>
              <li class="nav-item-btn text-center nav-item">
                <button class="btn-shadow btn-wide btn-pill btn btn-focus btn-sm">View Latest Changes</button>
              </li>
            </ul>
          </div>
        </div><?php */?>
        <div class="header-btn-lg pr-0">
          <div class="widget-content p-0">
            <div class="widget-content-wrapper">
              <?php /*?><div class="widget-content-left">
                <div class="btn-group settingBox"> <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn fa-spin"><img src="{{asset('assets/images/setting.svg')}}" alt=""></a>
                  <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                    <button type="button" tabindex="0" class="dropdown-item" onclick="window.location.href='account.php'">My Account</button>
                    <button type="button" tabindex="0" class="dropdown-item" onclick="window.location.href='account-setting.php'">Account Settings</button>
                    <button type="button" tabindex="0" class="dropdown-item" onclick="window.location.href='change-password.php'">Change Password</button>
                    <div tabindex="-1" class="dropdown-divider"></div>
                    <button type="button" tabindex="0" class="dropdown-item">Log Out</button>
                  </div>
                </div>
              </div><?php */?>
              <div class="widget-content-right text-right  ml-5 header-user-info">
                <div class="widget-heading">{{ $user->name }}</div>
                <div class="widget-subheading">{{ $user->professional }}</div>
              </div>
              <div class="widget-content-right header-user-info ml-3">
                <button type="button" class="p-1 btn profilePic"  data-toggle="dropdown"> @if($user && $user->image)
                 
                 <img src="{{asset('/storage/uploads/instructor/'.$user->image)}}" />
                 @else
                <img src="{{asset('/assets/images/profile.svg')}}" alt="" /> @endif <span class="profileOn"></span></button>
                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                    <button type="button" tabindex="0" class="dropdown-item" onclick="window.location.href='{{ route('instructor-account-setting') }}'">Account Settings</button>
                    <div tabindex="-1" class="dropdown-divider"></div>
                    <button type="button" tabindex="0" class="dropdown-item" onClick="window.location='{{ route('instructor-logout') }}'">Log Out</button>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>