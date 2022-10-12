@php 
  use App\Models\Instructor;
@endphp
@if ($instructors->count() > 0)
    <section>
        <div class="container">
            <div class="titleWithAllbtn pt-5">
                <h1 class="txtBlue">Meet Professionals</h1>
                <a class="vallBtn" href="{{ route('professionals') }}">View All</a>
            </div>
            <!-- <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p> -->
            <div class="row teacherCards gx-4 mt-2">
                @foreach ($instructors as $instructor)
                    @php
                      $total_students = 0;
                      $avg_rating = Instructor::avg_rating($instructor->id); 
                    @endphp
                    @if (count($instructor->courses) > 0)
                        @foreach ($instructor->courses as $course)
                            @php  $total_students = $total_students + $course->sales->count(); @endphp
                        @endforeach

                      <div class="col-lg-4 col-md-4 col-sm-12">
                          <div class="card">
                              <div class="d-flex align-items-center">
                                  <div class="image"> <a href="{{ route($instructor->slug) }}">
                                          @if ($instructor->image)
                                              <img src="{{ asset('storage/uploads/instructor/' . $instructor->image) }}"
                                                  class="rounded" width="155">
                                          @else
                                              <img src="{{ asset('assets/images/teacher.png') }}" class="rounded"
                                                  width="155">
                                          @endif
                                      </a></div>
                                  <div class="ml-3 w-100">
                                      <h3 class="mb-2 mt-0">{{ $instructor->name }}</h3>
                                      <h4>{{ $instructor->professional }}</h4>
                                      <div
                                          class="mt-2 bg-primary d-flex justify-content-between rounded text-white stats">
                                          <div class="d-flex flex-column dtls-bdr"> <span class="articles">Courses</span>
                                              <span class="number1">{{ count($instructor->courses) }}</span> </div>
                                          <div class="d-flex flex-column dtls-bdr"> <span
                                                  class="followers">Students</span> <span
                                                  class="number2">{{ $total_students }}</span> </div>
                                          <div class="d-flex flex-column dtls-bdr"> <span class="rating">Rating</span>
                                              <span class="number3">{{ $avg_rating }}</span> </div>
                                      </div>

                                      <div class="button mt-2 d-flex flex-row align-items-center">
                                          <button type="button" class="btn btn-sm btn-blue2 w-100"
                                              onClick="window.location.href='{{ route($instructor->slug) }}'">View
                                              Profile</button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                    @endif
                @endforeach


            </div>
        </div>
    </section>
@endif
