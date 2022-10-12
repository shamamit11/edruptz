@extends('instructor.layout')
@section('content')
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header"> @include('instructor.includes.header')
  <div class="app-main"> @include('instructor.includes.nav')
    <div class="app-main__outer">
      <div class="app-main__inner">
        <ol class="nobg breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('instructor-dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Courses</li>
        </ol>
        <div class="app-page-title">
         @include('instructor.includes.alert')
          <div class="page-title-wrapper">
            <div class="page-title-heading">
              <div>Manage Courses
              </div>
            </div>
            <div class="page-title-actions">
             
              <div class="d-inline-block">
                <button type="button" class="btn-shadow btn btn-success" onclick="window.location.href='{{ route('instructor-course-add') }}'"> <span class="btn-icon-wrapper pr-2 opacity-7"> <i class="fa fa-plus fa-w-20"></i> </span> Create Course </button>
              </div>
            </div>
          </div>
        </div>
        <div class="card-shadowNone mt-3">
          <div class="card card-body border-left-3 border-left-primary navbar-shadow mb-4">
             <form method="get">
              <div class="d-flex flex-wrap2 align-items-center mb-headings">
                <?php /*?><div class="dropdown"> <a href="#" data-toggle="dropdown" class="btn btn-white filterBtn" aria-expanded="false"><i class="fa fa-sliders mr-sm-2"></i> <span class="d-none d-sm-block">Filters</span></a>
                  <div class="dropdown-menu" style="">
                    <div class="dropdown-item d-flex flex-column"> 
                      <div class="form-group">
                        <label for="custom-select" class="form-label">Category</label>
                        <br>
                        <select id="custom-select" class="form-control custom-select" style="width: 200px;">
                          <option selected="">All categories</option>
                          <option value="1">Vue.js</option>
                          <option value="2">Node.js</option>
                          <option value="3">GitHub</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="published01" class="form-label">Published</label>
                        <br>
                        <select id="published01" class="form-control custom-select" style="width: 200px;">
                          <option selected="">Published courses</option>
                          <option value="1">Draft courses</option>
                          <option value="3">All courses</option>
                        </select>
                      </div>
                      <a href="#">Clear filters</a> </div>
                  </div>
                </div><?php */?>
                <div class="flex search-form ml-3 search-form--light">
                 @csrf
                        <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Search courses">
                  <button class="btn filterSearchBtn" type="submit" role="button"><i class="fa fa-search"></i></button>
                </div>
              </div>
              <?php /*?><div class="d-flex flex-column flex-sm-row align-items-sm-center" style="white-space: nowrap;"> <small class="flex text-muted text-uppercase mr-3 mb-2 mb-sm-0">Displaying 4 out of 10 courses</small>
                <div class="w-auto ml-sm-auto table d-flex align-items-center mb-0"> <small class="text-muted text-uppercase mr-3 d-none d-sm-block">Sort by</small> <a href="#" class="sort desc small text-uppercase">Course</a> <a href="#" class="sort small text-uppercase ml-2">Earnings</a> <a href="#" class="sort small text-uppercase ml-2">Sales</a> </div>
              </div><?php */?>
            </form>
          </div>
        </div>
       
        @if($courses->count() > 0)
        <div class="card-shadowNone">
          <div class="row">
          @foreach($courses as $course)
            <div class="col-md-6"  id="course-{{ $course->id }}">
              <div class="card mb-4">
                <div class="card-body">
                  <div class="d-flex flex-column flex-sm-row"> <a href="{{route('instructor-course-add', ['id='. Crypt::encryptString($course->id)])}}" class="coursesListPic avatar avatar-lg avatar-4by3 mb-3 w-xs-plus-down-100 mr-sm-3"> @if($course->image)
                   <img src="{{ asset('storage/uploads/course/'.$course->image)}}" alt="Card image cap" class="avatar-img rounded">
                   @else
                  <img src="{{ asset('assets/images/no-course-image.png')}}" alt="Card image cap" class="avatar-img rounded"> 
                  @endif</a>
                    <div class="courseListDetails flex" > 
                      <!-- <h5 class="card-title text-base m-0"><a href="instructor-course-edit.html"><strong>Learn Vue.js</strong></a></h5> -->
                      <h4 class="card-title mb-1"><a href="{{route('instructor-course-add', ['id='. Crypt::encryptString($course->id)])}}">{{ $course->name }}</a></h4>
                      <p class="text-black-70">{{ $course->summary }}</p>
                      <div class="addEditBox d-flex align-items-end">
                        <div class="d-flex flex flex-column mr-3">
                          <div class="d-flex align-items-center py-1 border-bottom"> <small class="text-black-70 mr-2">USD {{ $course->amount }}</small> <small class="text-black-50">{{ count($course->sales) }} SALES</small> </div>
                          <div class="d-flex align-items-center py-1"> <small class="text-muted mr-2">{{ $course->category->name }}</small> </div>
                        </div>
                        <div class="text-center"> <a href="{{route('instructor-lesson', ['course_id='. Crypt::encryptString($course->id)])}}" class="btn btn-lg addEditBtn">Add / Edit Lesson  ({{count($course->lessons)}})</a> </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card__options dropdown right-0 pr-2"> <a href="#" class="editToggle dropdown-toggle text-muted roundBdr" data-caret="false" data-toggle="dropdown"> <i class="fa fa-ellipsis-v"></i> </a>
                  <div class="dropdown-menu dropdown-menu-right"> 
                    <a class="dropdown-item" href="{{route('instructor-course-add', ['id='. Crypt::encryptString($course->id)])}}">Edit course</a>
                    </div>
                </div>
              </div>
            </div>
           @endforeach
          </div>
          <nav>
             <div class="align-middle"> {{ $courses->links('pagination::bootstrap-4') }} </div>
          </nav>
        </div>
        @else
        <div class="alert alert-light alert-dismissible border-1 border-left-3 border-left-warning" role="alert">
         
          <div class="text-black-70">Ohh no! No courses to display. Add some courses.</div>
        </div>
            @endif
      </div>
      @include('instructor.includes.footer')
    </div>
  </div>
</div>
@endsection 

@section('footer-scripts')
<script>
$(document).ready(function() {
    $('.delete-row-btn').click(function() {
        var id = $(this).data("id");
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            reverseButtons: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("instructor-course-delete")}}',
                    type: 'POST',
                    data: {
                        'id': id,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function() {
                        $("#course-" + id).remove();
                        swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'Your data has been deleted.',
                            'success'
                        );
                    }
                });
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    '',
                    'error'
                )
            }
        })
    });
});
</script>
@endsection